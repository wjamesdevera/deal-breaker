<?php

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location: index.php');
    die();
}

use DealBreaker\Model\User;

$userObject = new User();
$randomUsernameGenerator = new RandomUsernameGenerator();


if (isset($_POST['username'])) {
    $username = sanitizeInput($_POST['username']);
    if (userExist($username)) {
        $_SESSION['logged_in'] = true;
        $_SESSION['logged_user'] = $userObject->fetchUser($username);
        header('location: index.php');
        die();
    } else if (!empty($username)) {
        $userObject->addNewUser($username);
        $_SESSION['logged_in'] = true;
        $_SESSION['logged_user'] = $userObject->fetchUser($username);
        header('location: index.php');
        die();
    } else {
        $randomUser = $randomUsernameGenerator->generateRandomUsername();
        if (userExist($randomUser)) {
            $randomUser = $randomUsernameGenerator->generateRandomUsername();
        }
        $userObject->addNewUser($randomUser);
        $_SESSION['logged_in'] = true;
        $_SESSION['logged_user'] = $userObject->fetchUser($randomUser);
        header('location: index.php');
        die();
    }
}

function userExist(string $username): bool
{
    global $userObject;
    $users = $userObject->fetchUsers();
    foreach ($users as $user) {
        if ($user['username'] == $username) {
            return true;
        }
    }
    return false;
}


function sanitizeInput(string $data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


class RandomUsernameGenerator
{
    private const ADJECTIVE_NOUN_DICT = array(
        "big" => array("apple", "house", "dog", "idea", "dream", "city", "tree", "ocean", "mountain", "car"),
        "small" => array("cat", "car", "box", "room", "child", "phone", "coin", "ant", "island", "village"),
        "happy" => array("person", "family", "day", "smile", "moment", "song", "childhood", "dog", "couple", "laughter"),
        "sad" => array("song", "movie", "story", "memory", "tear", "day", "poem", "film", "heart", "novel"),
        "beautiful" => array("flower", "sunset", "painting", "poem", "landscape", "music", "soul", "person", "dream", "relationship"),
        "ugly" => array("truth", "sweater", "situation", "building", "reality", "argument", "scar", "revelation", "sight", "truth"),
        "funny" => array("joke", "clown", "movie", "situation", "story", "moment", "incident", "remark", "show", "prank"),
        "serious" => array("conversation", "talk", "discussion", "meeting", "issue", "decision", "undertaking", "problem", "question", "speech"),
        "smart" => array("phone", "idea", "solution", "decision", "person", "technology", "move", "mind", "gadget", "answer"),
        "dumb" => array("question", "mistake", "move", "idea", "joke", "comment", "action", "statement", "decision", "error"),
        "fast" => array("car", "runner", "speed", "food", "life", "pace", "track", "train", "wind", "boat"),
        "slow" => array("turtle", "motion", "learner", "progress", "life", "time", "day", "week", "growth", "process"),
        "loud" => array("music", "speaker", "voice", "noise", "applause", "argument", "crowd", "sound", "laugh", "shout"),
        "quiet" => array("library", "room", "person", "sound", "voice", "manner", "reflection", "thought", "whisper", "place"),
        "bright" => array("light", "star", "idea", "smile", "day", "future", "mind", "sun", "color", "hope"),
        "dark" => array("night", "room", "secret", "alley", "past", "forest", "chocolate", "shade", "side", "mood")
    );

    public function generateRandomUsername(): string
    {
        $adjective = array_keys(self::ADJECTIVE_NOUN_DICT)[random_int(0, count(array_keys(self::ADJECTIVE_NOUN_DICT)) - 1)];
        $noun = self::ADJECTIVE_NOUN_DICT[$adjective][random_int(0, count(self::ADJECTIVE_NOUN_DICT[$adjective]) - 1)];
        return $adjective . $noun . random_int(0, 999);
    }
}

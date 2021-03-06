<?php


class Wall_of_Fame
{
    public $difficulty;

    public function getAllScores($bdd, $difficulty)
    {
        echo "<table id='Scores_Wall'>";
        if ($difficulty > 8 && $difficulty < 11 )//DifficultÃ©  = Hard
        {
            echo
            "<thead>
                <th>Login</th>
                <th>Scores</th>
                <th>Hard</th>
            </thead>";
            $query = $bdd->query("SELECT hard.id, hard.scores, user.login
            FROM hard JOIN user WHERE hard.id_user = user.id ORDER BY hard.scores DESC LIMIT 10");
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            for ($i = 0; $i < count($result); $i++) {
                echo "<tr>
                            <td>" . $result[$i]['login'] . "</td>
                            <td>" . $result[$i]['scores'] . "</td>
                </tr>";
            }
        }elseif($difficulty > 2 && $difficulty < 6 )//DifficultÃ©  = easy
        {
            echo
            "<thead>
                <th>Login</th>
                <th>Scores</th>
                <th>Easy</th>
            </thead>";
            $query = $bdd->query("SELECT easy.id, easy.scores, user.login
            FROM easy JOIN user WHERE easy.id_user = user.id ORDER BY easy.scores DESC LIMIT 10");
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            for ($i = 0; $i < count($result); $i++) {
            echo "<tr>
                            <td>" . $result[$i]['login'] . "</td>
                            <td>" . $result[$i]['scores'] . "</td>
                </tr>";
            }
        }elseif ($difficulty > 5 && $difficulty < 9 )//DifficultÃ©  = normal
        {
            echo
            "<thead>
                <th>Login</th>
                <th>Scores</th>
                <th>Normal</th>
            </thead>";
            $query = $bdd->query("SELECT normal.id, normal.scores, user.login
            FROM normal JOIN user WHERE normal.id_user = user.id ORDER BY normal.scores DESC LIMIT 10");
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            for ($i = 0; $i < count($result); $i++) {
                echo "<tr>
                                <td>" . $result[$i]['login'] . "</td>
                                <td>" . $result[$i]['scores'] . "</td>
                    </tr>";
            }
        }else { //DifficultÃ©  = perso
            echo "<thead>
                    <th>Login</th>
                    <th>Scores</th>
                    <th>Nombre de Pairs</th>
                    <th>Perso</th>
                </thead>";
            $query = $bdd->query("SELECT perso.id, perso.scores, .perso.nb_pairs, user.login
            FROM perso JOIN user WHERE perso.id_user = user.id ORDER BY perso.scores DESC LIMIT 10");
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            for ($i = 0; $i < count($result); $i++) {
                echo "<tr>
                                <td>" . $result[$i]['login'] . "</td>
                                <td>" . $result[$i]['scores'] . "</td>
                                <td>" . $result[$i]['nb_pairs'] . "</td>
                    </tr>";
            }
        }
        echo "</table>";
    }

    public function insertscores(){

    }

}


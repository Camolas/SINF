



                        <?php
                        $table_headers = ["Rendering engine", "Browser", "Platform(s)", "Engine version", "CSS grade"];
                        $entry = [
                            "Rendering engine" => "Trident",
                            "Browser" => "Internet Explorer 4.0",
                            "Platform(s)" => "Win 95+",
                            "Engine version" => "4",
                            "CSS grade" => "X"
                        ];
                        $entries = [];
                        for ($i = 0; $i < 1000; $i++)
                            array_push($entries, $entry);

                        include('../templates/header.php');
                        include('../templates/agenda.php');
                        include('../templates/table.php');
                        include('../templates/footer.php');
                        ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: arial;
        }

        body {
            padding: 30px 0 0 50px;
        }


        .note-content {
            margin-bottom: 20px;
            padding: 10px;
            width: fit-content;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .user-container {
            margin: 35px;
            padding: 20px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        }

        .user-container label {
            font-weight: bold;
        }

        .user-container input {
            display: block;
            height: 30px;
            min-width: 200px;
            margin: 5px 0;
            font-size: 1em;
            padding-left: 2px;
        }

        .validation {
            padding: 10px 20px;
            text-transform: uppercase;
            background-color: #FFF;
            border: 1px solid #0009;
            cursor: pointer;
            font-weight: bold;
            transition: 0.2s;
        }

        .validation:hover {
            background-color: #000;
            color: #FFF;

        }
    </style>

</head>
<body>

    <?php 
        $data = file_get_contents('note.json');
        $data = json_decode($data, true);
    ?>

    <h1>Test d'import - export de données grace à un fichier externe</h1>
    <p>Techno : JS - PHP - JSON</p>

    <div class="note-content">
        <?php 
            $index = 1;
            foreach($data as $key => $value) {
                echo "<div class='user-container'>";
                echo "<input type='text' name='users.name.".$index."' value='".$value["name"]."'>";
                echo "<input type='text' name='users.age.".$index."' value='".$value["age"]."'>";
                echo "<input type='text' name='users.city.".$index."' value='".$value["city"]."'>";
                echo "</div>";
                $index++;
            }
               
        ?>
    </div>


    <button class="validation">Enregistrer</button>
    

    <script>


        document.querySelector('.validation').addEventListener('click', (e) => {
            e.preventDefault();

            let inputData = [];

            let index = 0;
            document.querySelectorAll('.user-container').forEach(container => {
                inputData.push({});
                inputData[index]["name"] = container.children[0].value;
                inputData[index]["age"] = container.children[1].value;
                inputData[index]["city"] = container.children[2].value;

                index++;
            })

            let validator = true;
            document.querySelectorAll('.user-container input').forEach(input => {
                if(input.value.length <= 0) 
                    validator = false;
            });

            if(validator) {
                fetch('script.php', {method: "POST", body: JSON.stringify(inputData)})
                .then(response => response.json())
                .then(data => console.log(data));   
            }
            

            window.location.reload();
        });
    </script>
</body>
</html>
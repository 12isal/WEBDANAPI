<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            /* display: flex;
            flex-direction: row;
            align-content: center;
            justify-content: center; */
            margin: 0;
            background-color: rgb(58, 58, 83);
            width: 100%;
            padding: auto;

        }
        .container{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 720px;
        }
        .kotak{
            background-color: rgb(64, 93, 118);
            box-shadow:  0px 15px 10px 10px rgb(0, 88, 197) ;
            width: 400px;
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-radius: 10px;
            border: solid 2px blue;
        }
        .judul{
            color: aliceblue;
            font-family: 'Courier New', Courier, monospace;

        }
        .kotak textarea{
            border: none;
            width: 200px;
            height: 200px;
            box-sizing: border-box;
            resize: none;
            font-size: 16px;
            padding: 10px;
            border-radius:10px; 
        }
        .kotak textarea:focus{
            outline: none;
            
        }
        .kotak button{
            border: none;
            background-color: rgb(34, 34, 243);
            color: white;
            padding: 10px 20px 10px 20px ;
            margin-top: 20px;
            border-radius: 4px;
        }
        .kotak button:hover{
            box-shadow:  0px 5px 5px 5px rgba(180, 196, 215, 0.337) ;
            background-color: aliceblue;
            color: rgb(34, 34, 243);
        }


    </style>
</head>
<body>
    <div class="container">
        <div class="kotak">
            <div class="judul"><h3>Pesan untuk</h3></div>
            <form action="/tamuKirim" method="post">
                @csrf
            <textarea type="text" placeholder=" Buatlah Pesan" name="pesan" required></textarea><br> 
            <button type="submit">simpan</button>
            </form>
        </div>
    </div>
</body>
</html>
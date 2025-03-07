<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trucking Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #fff;
        }
        .container {
            display: flex;
            gap: 20px;
        }
        .card {
            background-color: #fff;
            border: 2px solid #000;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
            position: relative;
        }
        .card img {
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .card h1 {
            font-size: 18px;
            margin: 10px 0;
        }
        .card form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .card input[type="text"],
        .card input[type="password"] {
            padding: 10px;
            border: 1px solid #000;
            border-radius: 5px;
        }
        .card button {
            background-color: #ca8a04;
            color: #1f2937;
            padding: 10px;
            border: 1px solid #000;
            border-radius: 5px;
            cursor: pointer;
        }
        .card a {
            color: #fff;
            text-decoration: none;
            font-size: 12px;
        }
        .header {
            background-color: #1f2937;
            color: #fff;
            padding: 10px;
            border-radius: 0;
            font-size: 18px;
        }
        .inner-card {
            background-color: #ca8a04;
            border: 2px solid #000;
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
            position: relative;
        }
        .inner-card .logo {
            border-radius: 50%;
            margin: 0 auto 10px auto;
            background-color: #1f2937;
            color: #fff;
            border: 2px solid #000;
            padding: 5px;
            font-size: 10px;
            font-weight: bold;
            width: 50px;
            height: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .inner-card button.create-account {
            background-color: #1f2937;
            color: #fff;
        }
        .card.second-card {
            background-color: #f0c75e;
        }
        .inner-card.second-inner-card {
            background-color: #fff;
            border: 2px solid #000;
        }
        .inner-card.second-inner-card .logo {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #1f2937;
            color: #fff;
            border: 2px solid #000;
            border-radius: 50%;
            padding: 5px;
            font-size: 10px;
            font-weight: bold;
            width: 50px;
            height: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .inner-card.second-inner-card h1 {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                Trucking Management System
            </div>
            <div class="inner-card">
                <div class="logo">
                    &lt;/&gt;<br>TEAM<br>Cipher
                </div>
                <h1>
                    WELCOME BACK!
                </h1>
                <form method="POST" action="/login">
                <?php echo csrf_field(); ?>
                    <input placeholder="Username" type="text" name="username" required/>
                    <input placeholder="Password" type="password" name="password" required/>
                    <button style="background-color: #fbbf24; color: #fff; border: 1px solid #000;" type="submit">
                        Login
                    </button>
                </form>

                <?php if(session('incorrect_msg')): ?>
                     <script>
                         alert("<?php echo e(session('incorrect_msg')); ?>");
                     </script>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\USER\Desktop\TruckingMS\tms\resources\views/login.blade.php ENDPATH**/ ?>
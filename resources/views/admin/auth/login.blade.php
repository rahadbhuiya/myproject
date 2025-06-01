<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Login</title>
    <style>
        /* Reset & base */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
            color: #333;
        }
        form {
            background: white;
            padding: 2.5rem 2rem;
            border-radius: 12px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            color: #4a4a4a;
        }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.4rem;
            color: #555;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.6rem 0.8rem;
            border: 1.8px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
            margin-bottom: 1.25rem;
            outline-offset: 2px;
        }
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 6px rgba(102, 126, 234, 0.6);
        }
        button[type="submit"] {
            width: 100%;
            padding: 0.75rem 0;
            background: #667eea;
            color: white;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background: #5563d6;
        }
        .error-message {
            background-color: #ffe6e6;
            color: #cc0000;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.25rem;
            font-weight: 600;
            text-align: center;
            box-shadow: 0 0 5px rgba(204, 0, 0, 0.25);
        }
        @media (max-width: 450px) {
            form {
                padding: 2rem 1.5rem;
                border-radius: 10px;
            }
            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('admin.login.submit') }}" autocomplete="off">
        @csrf
        <h2>Admin Login</h2>

        @if($errors->any())
            <div class="error-message">{{ $errors->first() }}</div>
        @endif

        <label for="email">Email</label>
        <input id="email" type="email" name="email" required autocomplete="email" autofocus />

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required autocomplete="new-password" />

        <button type="submit">Login</button>
    </form>
</body>
</html>

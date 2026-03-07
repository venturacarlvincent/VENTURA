<x-layout>
    <x-slot:heading>
        Welcome
    </x-slot:heading>

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .container {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        h1 {
            color: #333;
        }

        p {
            font-size: 18px;
        }
    </style>

    <div class="container">
        <h1>Welcome!</h1>
        <p>Hello, <strong>{{ $name }}</strong>!</p>
    </div>
</x-layout>
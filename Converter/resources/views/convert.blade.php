<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Números Romanos</title>
</head>
<body>
    <h1>Conversor de Números Romanos e Arábicos</h1>
    <form method="POST" action="/convert">
        @csrf
        <label for="input">Número:</label>
        <input type="text" id="input" name="input" required>
        <br>
        <input type="radio" id="to_arabic" name="type" value="to_arabic" checked>
        <label for="to_arabic">Romano para Arábico</label>
        <br>
        <input type="radio" id="to_roman" name="type" value="to_roman">
        <label for="to_roman">Arábico para Romano</label>
        <br>
        <button type="submit">Converter</button>
    </form>
    @if(isset($result))
        <h2>Resultado: {{ $result }}</h2>
    @endif
</body>
</html>

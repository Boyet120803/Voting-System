html_content = '''
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animated Flower</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="flower">
        <div class="stem"></div>
        <div class="petal petal1"></div>
        <div class="petal petal2"></div>
        <div class="petal petal3"></div>
        <div class="petal petal4"></div>
        <div class="center"></div>
    </div>
    <script src="script.js"></script>
</body>
</html>
'''

with open('one.html', 'w') as file:
    file.write(html_content)

print("HTML file generated successfully.")

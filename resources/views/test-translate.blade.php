<!DOCTYPE html>
<html>
<head>
    <title>Test Translate Menu API</title>
</head>
<body>
    <h2>Test API Translate Menu</h2>
    <form id="translateForm">
        <label for="menuId">Menu ID (UUID):</label><br>
        <input type="text" id="menuId" name="menuId" required><br><br>

        <button type="submit">Translate</button>
    </form>

    <h3>Response:</h3>
    <pre id="response"></pre>

    <script>
        document.getElementById('translateForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const menuId = document.getElementById('menuId').value;

            fetch(`http://localhost:8000/api/menu/${menuId}/translate`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('response').textContent = JSON.stringify(data, null, 4);
                })
                .catch(error => {
                    document.getElementById('response').textContent = 'Error: ' + error;
                });
        });
    </script>
</body>
</html>

<script>
    name();

    async function name() {
        const res = await fetch("https://libretranslate.com/translate", {
            method: "POST",
            body: JSON.stringify({
                q: "Hello!",
                source: "en",
                target: "es",
            }),
            headers: { "Content-Type": "application/json" },
        });

        console.log(await res.json());
    }
</script>

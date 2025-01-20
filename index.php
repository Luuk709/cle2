<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <link rel="stylesheet" href="./style.css">
    <title>CutOrDye</title>
</head>
<body>
   <?php include './components/nav.php';?>
    <main>
        <section class=" mg-large section is-flex" style="justify-content: center">
            <div class="foto-container is-flex-direction-row is-3" style="padding: max(50px) justify-content: space-between" >
                <div  class="is-flex image columns is-3" style="justify-content: space-between ">
                    <a href="makeReservation.php?id=1"><img class="picture" src="./fotos/hair1.jpeg" alt="hair 1"/></a>
                    <a href="makeReservation.php?id=2"><img class="picture" src="./fotos/hair2.jpeg" alt="hair 2" /></a>
                </div>
                <div  class="is-flex  columns is-3" style="justify-content: space-around ">
                    <strong>Color</strong>
                    <strong>Color & Cut</strong>
                </div>
                <div class="is-flex image columns is-3" style="justify-content: space-between" >
                    <a href="makeReservation.php?id=3"><img class="picture" src="./fotos/hair3.jpeg" alt="hair 3"/></a>
                    <a href="makeReservation.php?id=4"><img class="picture" src="./fotos/hair4.jpeg" alt="hair 4"/></a>
                </div>
                <div  class="is-flex  columns is-3" style="justify-content: space-around ">
                    <strong>Toner</strong>
                    <strong>Toner & Root</strong>
                </div>

            </div>
            <script>
                // Add click event listeners to the pictures
                // document.querySelectorAll('.picture').forEach(img => {
                //     img.addEventListener('click', () => {
                //         const pictureName = img.getAttribute('data-name');
                //
                //         // Send the picture name to the server
                //         fetch('service.php', {
                //             method: 'POST',
                //             headers: {
                //                 'Content-Type': 'application/json'
                //             },
                //             body: JSON.stringify({ picture_name: pictureName })
                //         })
                //             .then(response => response.json())
                //             .then(data => {
                //                 if (data.success) {
                //                     alert('Service saved successfully!');
                //                 } else {
                //                     alert('Error');
                //                 }
                //             })
                //             .catch(error => console.error('Error:', error));
                //     });
                // });
            </script>
        </section>
    </main>
    <footer class="footer" style="background-color: #C4C4C4" >
        <div class="is-flex columns is-1 has-text-centered ">
        <a class="column" href="#">Privacy</a>
        <a class="column" href="#">Terms & Conditions</a>
        <a class="column" href="#">Cookie</a>
        <a class="column" href="#">Contact</a>
           <p>© CutOrDye </p>
        </div>
    </footer>
</body>
</html>
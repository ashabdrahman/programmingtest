<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Game</title>

    <!-- Bootstrap Theme-->
    <link rel="stylesheet" href="https://bootswatch.com/4/minty/bootstrap.min.css">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Sweet Alert 2 -->
    <script src="js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">

</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 m-auto">
                <div class="card card-body">
                    <h1 class="text-center mb-3"><i class="fas fa-sign-in-alt"></i>  Card Game</h1>
                    <div class="form-group">
                        <label for="email">Number of Players:</label>
                        <input
                        type="number"
                        id="players"
                        name="players"
                        class="form-control"
                        placeholder="Enter Number of Players"
                        />
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" id="dealCards">Deal Cards</button>
                    <div id="desks"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            /**
             * Attaches a click event handler to the element with the ID dealCards.
             *
             * @param int players
             * Sends a POST request to api/randdeck.php with the number of players as data.
             * Parses the JSON response from the server.
             * Loops through each player's hand and displays it.
            */
            $('#dealCards').click(function() {
                var players = $('#players').val();

                $.post('api/randdeck.php', {
                    players: players
                }, function(data) {
                    let o = JSON.parse(data);
                    $('#desks').empty();

                    if (o.status == false) {
                        Swal.fire({
                            text: o.reason,
                            icon: "error"
                        });
                    } else {
                        var desks = o.data;
                        desks.forEach(function(desk, index) {
                            $('#desks').append('<h3>Player ' + (index + 1) + '</h3><p>' + desk.join(', ') + '<br>Total Card: ' + desk.length + '</p>');
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>

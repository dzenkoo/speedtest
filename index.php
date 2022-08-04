<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Speedtest Tool</title>

    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Speedtest Tool</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- Page content-->

    <div class="container">
        <br>
        <script>
            function format(d) {
                // `d` is the original data object for the row
                return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                    '<tr>' +
                    '<td>Send (Mbyte):</td>' +
                    '<td>' + d.byte_sent + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Recieved (Mbyte):</td>' +
                    '<td>' + d.bytes_received + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Packetloss (bytes):</td>' +
                    '<td>' + d.packetloss + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Jitter:</td>' +
                    '<td>' + d.jitter + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Server:</td>' +
                    '<td>' +
                    '<ul>' +
                    '<li>' + " Id: " + d.srv_id + '</li>' +
                    '<li>' + " Host: " + d.srv_host + '</li>' +
                    '<li>' + " Port: " + d.srv_port + '</li>' +
                    '<li>' + " Name: " + d.srv_name + '</li>' +
                    '<li>' + " Location: " + d.srv_location + '</li>' +
                    '<li>' + " Country: " + d.srv_country + '</li>' +
                    '<li>' + " IP: " + d.srv_ip + '</li>' +
                    '</ul>' +
                    '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Client:</td>' +
                    '<td>' +
                    '<ul>' +
                    '<li>' + " IP: " + d.client_ip + '</li>' +
                    '<li>' + " MAC: " + d.client_mac + '</li>' +
                    '</ul>' +
                    '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Proof:</td>' +
                    '<td>' +
                    '<ul>' +
                    '<li>' + " ID: " + d.id + '</li>' +
                    '<li>' + " URL: <a href='" + d.url + "'>" + d.url + "<a></li>" +
                    '</ul>' +
                    '</td>' +
                    '</tr>' +
                    '</table>';
            }

            $(document).ready(function () {
                        var table = $('#networking').DataTable({
                                "ajax": "./datasource_table.php",
                                dom: 'Bfrtip',
                                buttons: [
                                    'copyHtml5',
                                    'excelHtml5',
                                    'csvHtml5',
                                    'pdfHtml5'
                                ],
                                "responsive": true,
                                "order": [ [ 4, "desc" ], [ 5, "desc" ]],
                                    "columns": [{
                                            "className": 'dt-control',
                                            "orderable": false,
                                            "data": null,
                                            "defaultContent": ''
                                        },
                                        {
                                            "data": "download"
                                        },
                                        {
                                            "data": "upload"
                                        },
                                        {
                                            "data": "ping"
                                        },
                                        {
                                            "data": "date"
                                        },
                                        {
                                            "data": "time"
                                        }
                                    ]
                                });

                            // Add event listener for opening and closing details
                            $('#networking tbody').on('click', 'td.dt-control', function () {
                                var tr = $(this).closest('tr');
                                var row = table.row(tr);

                                if (row.child.isShown()) {
                                    // This row is already open - close it
                                    row.child.hide();
                                    tr.removeClass('shown');
                                } else {
                                    // Open this row
                                    row.child(format(row.data())).show();
                                    tr.addClass('shown');
                                }
                            });
                        });
        </script>
        <table id="networking" class="display">
            <thead>
                <tr>
                    <th>OPEN</th>
                    <th>Download (Mbit/s)</th>
                    <th>Upload (Mbit/s)</th>
                    <th>Ping (ms)</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
        </table>

        <div>
            <canvas id="netChart"></canvas>
        </div>
        <script>
            $(document).ready(function () {
                $.ajax({
                    url: "./datasource_chart.php",
                    method: "GET",
                    success: function (data) {
                        var data = (JSON.parse(data));
                        var download = [];
                        var upload = [];
                        var ping = [];
                        var datetime = [];
                        var datetimeall = [];

                        for (var i in data) {
                            download.push(data[i].download);
                            ping.push(data[i].ping);
                            upload.push(data[i].upload);
                            if (!datetime.includes(data[i].datetime)) {
                                datetime.push(data[i].datetime);
                            } else {
                                datetime.push(" ");
                            }
                            datetimeall.push(data[i].datetimeall)
                        }



                        var chartdata = {
                            labels: datetime,
                            datasets: [{
                                    label: 'Download',
                                    data: download,
                                    borderColor: 'rgb(51, 68, 255)',
                                    tension: 0.5

                                },
                                {
                                    label: 'Upload',
                                    data: upload,
                                    borderColor: 'rgb(255, 69, 51)',
                                    tension: 0.5
                                },
                                {
                                    label: 'Ping',
                                    data: ping,
                                    borderColor: 'rgb(73, 255, 51)',
                                    tension: 0.5
                                },

                            ]
                        };

                        var ctx = $("#netChart");

                        var lineGraph = new Chart(ctx, {
                            type: 'line',
                            data: chartdata,
                            options: {
                                plugins: {
                                    tooltip: {
                                        callbacks: {
                                            title: function (tooltipItem, data) {

                                                return datetimeall[tooltipItem[0][
                                                    'dataIndex'
                                                ]];
                                            },
                                        }
                                    }
                                }
                            }
                        });
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });
        </script>

    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>
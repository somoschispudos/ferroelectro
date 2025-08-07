<!DOCTYPE html>
<html>
<head>
    <title>DataTable with Date Filter</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
</head>
<body>
    <table id="myTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John</td>
                <td>2022-12-01</td>
                <td>1000</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Mary</td>
                <td>2022-12-10</td>
                <td>2000</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Bob</td>
                <td>2023-01-05</td>
                <td>1500</td>
            </tr>
        </tbody>
    </table>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable({
                columnDefs: [
                { type: 'date', targets: 0, data: 0, render: function(data, type, full, meta) {
                    return type === 'display' ? moment(data).format('MM/DD/YYYY') : data;
                    }
                }
                ]
            });
        });

    </script>
</body>
</html>

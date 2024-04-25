<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
</head>
<body>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>EFP</th>
                <th>avancement global</th>
                <th>avancement presentiel</th>
                <th>avancement distant</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($efps as $efp)
                <tr>
                    <td><a href="/efp/{{ $efp->id }}" >{{ $efp->nom }}</a></td>
                    <td>{{ round($avancement_g[$efp->nom],2) }}%</td>
                    <td>{{ round($avancement_p[$efp->nom],2) }}%</td>
                    <td>{{ round($avancement_s[$efp->nom],2) }}%</td>
                </tr>
            @endforeach

        </tbody>
    </table>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
    
    
    
    

    <script>
        new DataTable('#example');
    </script>
</body>
</html>
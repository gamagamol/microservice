<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Deploy microservice using open shift</h1>
        <div class="row mb-3">
            <div class="col-md-3">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal" id="button">add button</button>

            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <h1 id="nodejs">Node js</h1>
                <table border="1" cellspacing='0' cellpadding='3' class="table table-border">
                    <thead>

                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Progamming</td>
                        </tr>
                    </thead>
                    <tbody id="nbody">

                    </tbody>

                </table>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <h1 id="golang">Golang</h1>
                <table border="1" cellspacing='0' cellpadding='3' class="table table-border">
                    <thead>

                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Progamming</td>
                        </tr>
                    </thead>
                    <tbody id="gbody">

                    </tbody>

                </table>
            </div>


        </div>
    </div>


    <div class="modal" tabindex="-1" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-input mb-3">

                            <input type="text" class="form-control" id="name" placeholder="name">
                        </div>
                        <div class="form-input">
                            <select name="progamming" id="progamming" class="form-control">
                                <option value="node">node</option>
                                <option value="golang">golang</option>
                            </select>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="insert()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        $('#button').click(function() {
            $('#modal').modal('show')
        })


        // get data

        // message from node js
        $.ajax({
            url: 'http://localhost:3001',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                // $('#nodejs').text(data.message)
                let html = ''
                data.students.map((s) => {
                    html += `<tr>`
                    html += `<td>${s.id}</td>`
                    html += `<td>${s.name}</td>`
                    html += `<td>${s.progamming}</td>`
                    html += `</tr>`
                })

                $('#nbody').html(html)
            }
        })

        // message from golang

        $.ajax({
            url: 'http://localhost:3002',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                let html = ''
                data.students.map((s) => {
                    html += `<tr>`
                    html += `<td>${s.id}</td>`
                    html += `<td>${s.name}</td>`
                    html += `<td>${s.progamming}</td>`
                    html += `</tr>`
                })

                $('#gbody').html(html)
            }
        })


    })

    function insert() {
        let name = $('#name').val()
        let progamming = $('#progamming').val()

        let url = (progamming == 'node') ? 'http://localhost:3001' : 'http://localhost:3002'

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                name: name,
                progamming: progamming,
            },
            dataType: 'json',
            success: function(data) {
                location.reload()
            }
        })

    }
</script>

</html>
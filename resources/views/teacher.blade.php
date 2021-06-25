@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Profesores
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Launch demo modal
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/teacher" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="nombre" class="col-sm-2 col-form-label">nombre</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nombre" placeholder="nombre" name="nombre" >
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Cursos</th>
                            <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($teachers as $teacher)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$teacher->nombre}}</td>
                                <td>
                                    <ul>
                                        @foreach($teacher->cursos as $curso)
                                        <li>{{$curso->nombre}}</li>
                                        @endforeach
                                    </ul>

                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#update" data-nombre="{{$teacher->nombre}}" data-id="{{$teacher->id}}">Modificar</button>
                                        <form action="/teacher/{{$teacher->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"> Eliminar</button>
                                        </form>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                    <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="updateLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateLabel">New message</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formulario" action="/teacher/" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label for="nombre2" class="col-sm-2 col-form-label">nombre</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nombre2" placeholder="nombre" name="nombre" >
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload=function (){
        $('#update').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var nombre = button.data('nombre') // Extract info from data-* attributes
            var id=button.data('id');
            $('#nombre2').val(nombre);
            $('#formulario').attr('action','/teacher/'+id);
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Profesor ' + nombre)
            // modal.find('.modal-body input').val(recipient)
        })
    }
</script>
@endsection

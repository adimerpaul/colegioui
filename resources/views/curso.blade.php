@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Cursos
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
                                    <form action="/curso" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="nombre" class="col-sm-2 col-form-label">nombre</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nombre" placeholder="nombre" name="nombre" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="gestion" class="col-sm-2 col-form-label">gestion</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="gestion" placeholder="gestion" name="gestion" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="teacher_id" class="col-sm-2 col-form-label">teacher_id</label>
                                            <div class="col-sm-10">
                                                <select name="teacher_id" id="teacher_id" class="form-control" required>
                                                    <option value="">Seleccionar..</option>
                                                    @foreach($teachers as $teacher)
                                                        <option value="{{$teacher->id}}">{{$teacher->nombre}}</option>
                                                    @endforeach
                                                </select>
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
                            <th>Profesor</th>
                            <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cursos as $curso)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$curso->nombre}}</td>
                                <td>{{$curso->teacher->nombre}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#update" data-nombre="{{$curso->nombre}}" data-teacher_id="{{$curso->teacher_id}}"  data-gestion="{{$curso->gestion}}" data-id="{{$curso->id}}">Modificar</button>
                                        <form action="/curso/{{$curso->id}}" method="POST">
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
                                    <form id="formulario" action="/curso/" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label for="nombre2" class="col-sm-2 col-form-label">nombre</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nombre2" placeholder="nombre" name="nombre" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="gestion2" class="col-sm-2 col-form-label">gestion2</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="gestion2" placeholder="gestion" name="gestion" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="teacher_id2" class="col-sm-2 col-form-label">teacher_id</label>
                                            <div class="col-sm-10">
                                                <select name="teacher_id" id="teacher_id2" class="form-control" required>
                                                    <option value="">Seleccionar..</option>
                                                    @foreach($teachers as $teacher)
                                                        <option value="{{$teacher->id}}">{{$teacher->nombre}}</option>
                                                    @endforeach
                                                </select>
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
            $('#gestion2').val(button.data('gestion'));
            $('#teacher_id2').val(button.data('teacher_id'));
            $('#formulario').attr('action','/curso/'+id);
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Profesor ' + nombre)
            // modal.find('.modal-body input').val(recipient)
        })
    }
</script>
@endsection

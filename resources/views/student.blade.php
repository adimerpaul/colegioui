@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Estudiantes
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Launch demo modal
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/student" method="POST">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="nombre" class="col-sm-2 col-form-label">nombre</label>
                                                <div class="col-sm-10">
                                                    <input type="text"  class="form-control" name="nombre" id="nombre" placeholder="nombre">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="sexo" class="col-sm-2 col-form-label">sexo</label>
                                                <div class="col-sm-10">
{{--                                                    <input type="text"  class="form-control" id="nombre" placeholder="nombre">--}}
                                                    <input type="radio" name="sexo" value="M">Masculino
                                                    <input type="radio" name="sexo" value="F">Femenino
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="fechanac" class="col-sm-2 col-form-label">fecha</label>
                                                <div class="col-sm-10">
                                                    <input type="date" name="fechanac"  class="form-control" id="fechanac" placeholder="fechanac">
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
                                    <th>Sexo</th>
                                    <th>Fechanac</th>
                                    <th>Imagen</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$student->nombre}}</td>
                                    <td>{{$student->sexo}}</td>
                                    <td>{{$student->fechanac}}</td>
                                    <td>
                                        <img src="/imagen/{{$student->imagen}}" alt="" width="50">

                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#update"
                                                    data-id="{{$student->id}}"
                                                    data-nombre="{{$student->nombre}}"
                                                    data-sexo="{{$student->sexo}}"
                                                    data-fechanac="{{$student->fechanac}}"
                                            >Modificar</button>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#photo"
                                                    data-id="{{$student->id}}"
                                            >Cambiar imagen</button>
                                            <form method="POST" action="/student/{{$student->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="modal fade" id="update" tabindex="-1" aria-labelledby="updateLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateLabel">New message</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formulario" action="/student/" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <label for="nombre2" class="col-sm-2 col-form-label">nombre</label>
                                                <div class="col-sm-10">
                                                    <input type="text"  class="form-control" name="nombre" id="nombre2" placeholder="nombre">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="sexom" class="col-sm-2 col-form-label">sexo</label>
                                                <div class="col-sm-10">
                                                    {{--                                                    <input type="text"  class="form-control" id="nombre" placeholder="nombre">--}}
                                                    <input type="radio" name="sexo" id="sexom" value="M">Masculino
                                                    <input type="radio" name="sexo" id="sexof" value="F">Femenino
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="fechanac2" class="col-sm-2 col-form-label">fecha</label>
                                                <div class="col-sm-10">
                                                    <input type="date" name="fechanac"  class="form-control" id="fechanac2" placeholder="fechanac">
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
                        <div class="modal fade" id="photo" tabindex="-1" aria-labelledby="photoLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="photoLabel">New message</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formulario" action="/upload" method="POST" enctype="multipart/form-data" >
                                            @csrf
                                            <input type="text" id="id" hidden name="id">
                                            <div class="form-group row">
                                                <label for="imagen" class="col-sm-2 col-form-label">Imagen</label>
                                                <div class="col-sm-10">
                                                    <input type="file"  class="form-control" name="imagen" id="imagen" placeholder="nombre">
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
                var nombre = button.data('nombre')
                var sexo = button.data('sexo')
                var id = button.data('id')
                $('#formulario').prop('action','/student/'+id);
                $('#nombre2').val(nombre);
                if (sexo=='M')
                    $('#sexom').prop('checked',true);
                else
                    $('#sexof').prop('checked',true);
                $('#fechanac2').val(button.data('fechanac'));
                // $('#nombre').val(nombre);
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Estudiante ' + nombre)
                // modal.find('.modal-body input').val(recipient)
            })
            $('#photo').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id')
                $('#id').val(id);
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                // var modal = $(this)
                // modal.find('.modal-title').text('Estudiante ' + nombre)
                // modal.find('.modal-body input').val(recipient)
            })
        }
    </script>
@endsection

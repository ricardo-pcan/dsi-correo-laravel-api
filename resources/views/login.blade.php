@extends('layouts.dashboard')

@section( 'content' )
    <div class="container">
        <div class="row">
            <div class="login-legendContaineri text-center">
                <div class="col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                    <h2>Departamento de sistemas CGFIE</h2>
                </div>
            </div>
        </div>
        <div class="row">
           <div class="login-formContainer">
               <div class="col-sm-12 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                   <form class="form-horizontal">
                         <div class="form-group">
                           <div class="col-sm-12">
                             <input type="email" class="form-control" id="login-form-emailField" placeholder="Correo Electr&oacute;nico">
                           </div>
                         </div>
                         <div class="form-group">
                           <div class="col-sm-12">
                             <input type="password" class="form-control" id="login-form-passwordField" placeholder="Contrase&ntilde;a">
                           </div>
                         </div>
                         <div class="form-group">
                               <div class="col-sm-12">
                                     <button type="submit" class="btn btn-block btn-primary">Entrar</button>
                               </div>
                         </div>
                   </form>
               </div>
           </div>
        </div>
    </div>
@endsection

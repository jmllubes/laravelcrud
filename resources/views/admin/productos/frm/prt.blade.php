 <div class="row">
     <div class="col-md-12">
         <section class="panel">
             <div class="panel-body">
                 @if ( !empty ( $producto->id) )

                 <div class="mb3">
                     <label for="nombre" class="negrita">Nombre:</label>
                     <div>
                         <input class="form-control" placeholder="Introduce el nombre del producto" required="required" name="nombre" type="text" id="nombre" value="{{ $producto->nombre }}">
                     </div>
                 </div>

                 <div class="mb3">
                     <label for="descripcion" class="negrita">Descripcion:</label>
                     <div>
                         <input class="form-control" placeholder="Introduce la descripcion" required="required" name="nombre" type="text" id="nombre" value="{{ $producto->nombre }}">
                     </div>
                 </div>

                 <div class="mb3">
                     <label for="precio" class="negrita">Precio:</label>
                     <div>
                         <input class="form-control" placeholder="Introduce el precio" required="required" name="precio" type="text" id="precio" value="{{ $producto->precio }}">
                     </div>
                 </div>

                 <div class="mb3">
                     <label for="stock" class="negrita">Stock:</label>
                     <div>
                         <input class="form-control" placeholder="Introduce el stock" required="required" name="stock" type="text" id="stock" value="{{ $producto->stock }}">
                     </div>
                 </div>

                 <div class="mb3">
                     <label for="img" class="negrita">Selecciona una imagen:</label>
                     <div>
                         <input name="imagen" type="file" id="img">
                         <br>
                         <br>
                         @if ( !empty ( $producto->imagen) )

                         <span>Imagen Actual: </span>
                         <br>
                         <img src="../../../uploads/{{ $producto->imagen }}" width="200" class="img-fluid">

                         @else

                         <!-- Aún no se ha cargado una imagen para este producto -->

                         @endif
                     </div>

                 </div>
                 @else

                 <!--  Acá el formulario en Limpio para crear un nuevo registro -->
                 <div class="mb-3">
						<label for="nombre" class="negrita">Nombre:</label> 
						<div>
							<input class="form-control" placeholder="Zapatos Marrones de Cuero" required="required" name="nombre" type="text" id="nombre"> 
						</div>
					</div>

                    <div class="mb3">
                     <label for="descripcion" class="negrita">Descripcion:</label>
                     <div>
                         <input class="form-control" placeholder="Introduce la descripcion" required="required" name="descripcion" type="text" id="descripcion" >
                     </div>
                 </div>
 
					<div class="mb-3">
						<label for="precio" class="negrita">Precio:</label> 
						<div>
							<input class="form-control" placeholder="4.50" required="required" name="precio" type="text" id="precio"> 
						</div>
					</div>
 
					<div class="mb-3">
						<label for="stock" class="negrita">Stock:</label> 
						<div>
							<input class="form-control" placeholder="40" required="required" name="stock" type="text" id="stock"> 
						</div>
					</div>
 
					<div class="mb-3">
						<label for="img" class="negrita">Selecciona una imagen:</label>
						<div>
							<input name="imagen" type="file" id="img"> 
						</div>
					</div>

                 @endif

                 <button type="submit" class="btn btn-info">Guardar</button>
                 <a href="{{ route('admin/productos') }}" class="btn btn-warning">Cancelar</a>

                 <br>
                 <br>

             </div>
         </section>
     </div>
 </div>
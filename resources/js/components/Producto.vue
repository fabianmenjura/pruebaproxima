
<template>
    <div>
        <h1 class="text-center">Gestionar producots</h1>
        <hr>

        
  <!-- Button to Open the Modal -->
    <button @click="modificar=false; abrirModal();" type="button" class="btn btn-primary my-4">Nuevo</button>

    <!-- The Modal -->
    <div class="modal" :class="{mostrar: modal}">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">{{tituloModal}}</h4>
            <button @click="cerrarModal();"  type="button" class="close" data-dismiss="modal">
              &times;
            </button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
         
            <div class="my-4">
              <label for="nombre">Nombre</label>
              <input v-model="producto.nombre" type="text" class="form-control" id="nombre" placeholder="Nombre del Articulo">
            </div>
            <div class="my-4">
              <label for="descripcion">cantidad</label>
              <input v-model="producto.cantidad" type="text" class="form-control" id="descripcion" placeholder="Descripcion del Articulo">
            </div>
            <div class="my-4">
              <label for="stock">valor unitario</label>
              <input v-model="producto.valorunitario" type="number" class="form-control" id="stock" placeholder="Stock del Articulo">
            </div>
 
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">
              Cancelar
            </button>
            <button  @click="guardar();" type="button" class="btn btn-success" data-dismiss="modal">
              Guardar
            </button>


          </div>
        </div>
      </div>
    </div>



        <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">cantidad</th>
          <th scope="col">valorunitario</th>
        <th scope="col" colspan="2" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="pro in productos" :key="pro.id">
          <th scope="row">{{ pro.id }}</th>
          <td>{{ pro.nombre }}</td>
          <td>{{ pro.cantidad }}</td>
          <td>{{ pro.valorunitario }}</td>
          <td>
            <button  @click="modificar=true; abrirModal(pro);" class="btn btn-warning">Editar</button>
          </td>
          <td>
            <button @click="eliminar(pro.id)" class="btn btn-danger">
              Eliminar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    </div>
</template>



<script>
export default {
    data() {
        return {
      producto:{     
        nombre:'',
        cantidad:'',
        valorunitario:'',
      },
            modificar:true,
            modal:0,
            tituloModal:'',
            productos:[],
        }
    },
    methods: {
        async listar(){
            const res= await axios.get('/productos');
            this.productos= res.data;
        },
        async eliminar(id){
            const res= await axios.delete('/productos/'+id);
            this.listar();          
        },
    async guardar() {
      if(this.modificar){
        const res = await axios.put('/productos/'+this.id, this.producto);
        // console.log(this.id);

      }else{
        const res = await axios.post('/productos/', this.producto);
      }
      this.cerrarModal();
      this.listar();
    },
        abrirModal(data={}){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Producto";
        this.producto.nombre=data.nombre;
        this.producto.cantidad=data.cantidad;
        this.producto.valorunitario=data.valorunitario;
      }else{
        this.id=0;
        this.tituloModal="Crear Producto";
        this.producto.nombre='';
        this.producto.cantidad='';
        this.producto.valorunitario='';
      }
    },
     cerrarModal(){
      this.modal=0;
    },

    },
    created(){
        this.listar();
    }

}
</script>




<style>
   .mostrar{
    display: list-item;
    opacity: 1;
    background: rgba(75, 56, 143, 0.705);
  } 
</style>
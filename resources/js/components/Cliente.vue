
<template>
    <div>
        <h1 class="text-center">Gestionar Clientes</h1>
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
              <label for="nombre">Cedula</label>
              <input v-model="cliente.id" type="number" class="form-control" id="nombre" placeholder="Nombre del Articulo">
            </div>
            <div class="my-4">
              <label for="nombre">Nombre</label>
              <input v-model="cliente.nombre" type="text" class="form-control" id="nombre" placeholder="Nombre del Articulo">
            </div>
            <div class="my-4">
              <label for="descripcion">Apellido</label>
              <input v-model="cliente.apellido" type="text" class="form-control" id="descripcion" placeholder="Descripcion del Articulo">
            </div>
            <div class="my-4">
              <label for="stock">Celular</label>
              <input v-model="cliente.tipodocumento" type="number" class="form-control" id="stock" placeholder="Stock del Articulo">
            </div>
             <div class="my-4">
              <label for="descripcion">Direccion</label>
              <input v-model="cliente.ciudad" type="text" class="form-control" id="descripcion" placeholder="Descripcion del Articulo">
            </div>
             <div class="my-4">
              <label for="descripcion">Barrio</label>
              <input v-model="cliente.latitud" type="text" class="form-control" id="descripcion" placeholder="Descripcion del Articulo">
            </div>
            <div class="my-4">
              <label for="descripcion">Barrio</label>
              <input v-model="cliente.longitud" type="text" class="form-control" id="descripcion" placeholder="Descripcion del Articulo">
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
          <th scope="col">Apellido</th>
          <th scope="col">tipodocumento</th>
          <th scope="col">ciudad</th>
          <th scope="col">latitud</th>
          <th scope="col">longitud</th>
        <th scope="col" colspan="2" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="cli in clientes" :key="cli.id">
          <th scope="row">{{ cli.id }}</th>
          <td>{{ cli.nombre }}</td>
          <td>{{ cli.apellido }}</td>
          <td>{{ cli.tipodocumento }}</td>
          <td>{{ cli.ciudad }}</td>
          <td>{{ cli.latitud }}</td>
          <td>{{ cli.longitud }}</td>
          <td>
            <button  @click="modificar=true; abrirModal(cli);" class="btn btn-warning">Editar</button>
          </td>
          <td>
            <button @click="eliminar(cli.id)" class="btn btn-danger">
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
      cliente:{
        id:'',
        nombre:'',
        apellido:'',
        tipodocumento:'',
        ciudad:'',
        latitud:'',
        longitud:'',
      },
            modificar:true,
            modal:0,
            tituloModal:'',
            clientes:[],
        }
    },
    methods: {
        async listar(){
            const res= await axios.get('/clientes');
            this.clientes= res.data;
        },
        async eliminar(id){
            const res= await axios.delete('/clientes/'+id);
            this.listar();          
        },
    async guardar() {
      if(this.modificar){
        const res = await axios.put('/clientes/'+this.id, this.cliente);
        // console.log(this.id);

      }else{
        const res = await axios.post('/clientes/', this.cliente);
      }
      this.cerrarModal();
      this.listar();
    },
        abrirModal(data={}){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Cliente";
        this.cliente.id=data.id;
        this.cliente.nombre=data.nombre;
        this.cliente.apellido=data.apellido;
        this.cliente.tipodocumento=data.tipodocumento;
        this.cliente.ciudad=data.ciudad;
        this.cliente.latitud=data.latitud;
        this.cliente.longitud=data.longitud;
      }else{
        this.id=0;
        this.tituloModal="Crear Cliente";
        this.cliente.id=1;
        this.cliente.nombre='';
        this.cliente.apellido='';
        this.cliente.tipodocumento=1;
        this.cliente.ciudad='';
        this.cliente.latitud='';
        this.cliente.longitud='';
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
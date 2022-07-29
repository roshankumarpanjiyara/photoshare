<template>
    <div>
        <table class="table table-image">
            <thead>
                <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">View</th>
                    <th scope="col">Upload</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(album,index) in albums" :key="index">
                    <th scope="row">{{index+1}}</th>
                    <td class="w-25"><img :src="'/album/'+album.image" class="img-fluid img-thumbnail" alt="Sheep"></td>
                    <td>{{album.name}}</td>
                    <td>{{album.description}}</td>
                    <td>{{album.category.name}}</td>
                    <td>
                        <a :href="'/albums/'+album.slug+'/'+album.id">
                            <button class="btn btn-info">
                                View
                            </button>
                        </a>
                    </td>
                    <td>
                        <a :href="'/upload/images/'+album.id"><button class="btn btn-success">Upload</button></a>
                    </td>
                    <td>
                        <!-- Button trigger modal -->
                        <button @click.prevent="edit(album.id)" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Edit
                        </button>
                        <button @click.prevent="deleteRecord(album.id)" class="btn btn-danger">
                        Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination :meta="meta" v-on:pagination="getAlbums"></pagination>
        <edit :editrecord="records" @recordUpdated="recordUpdate"></edit>
    </div>
</template>
<script>
import EditComponent from './EditComponent.vue'
import PaginationComponent from './PaginationComponent.vue'
export default {
  components: { EditComponent, PaginationComponent },
    data(){
        return{
            albums:[],
            records:[],
            meta:{}
        }
    },
    created(){
        this.getAlbums()
    },
    methods:{
        getAlbums(page){
            axios.get('/getalbums',{
                params: {
                    page
                }
            }).then((response)=>{
            this.albums = response.data.data
            this.meta = response.data.meta
            }).catch((error)=>{
                console.log(error)
            })
        },
        edit(id){
            // alert(id)
            axios.get('/api/albums/'+id).then((response)=>{
                this.records = response.data
            }).catch((error)=>{
                alert('Unable to fetch data')
            })
        },
        recordUpdate(response){
            this.albums = response.data
        },
        deleteRecord(id){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.value) {
                axios.delete('/albums/'+id+'/delete').then((response)=>{
                  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                  this.albums = response.data
                }).catch((error)=>{
                    console.log(error)
                })
            }
            })
        }
    }
}
</script>

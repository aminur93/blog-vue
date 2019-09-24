<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Post</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Post List</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Post List</h3>
                                
                                <div class="card-tools">
                                    <button class="btn btn-primary">
                                        <router-link to="/post-new" style="color: #ffffff;">Add Post</router-link>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>User</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Photo</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(post,index) in getallPosts" :key="post.id">
                                        <td>{{ index+1 }}</td>
                                        <td v-if="post.user">{{ post.user.name }}</td>
                                        <td v-if="post.category">{{ post.category.cat_name}}</td>
                                        <td>{{ post.title | shortlength(20,"---") }}</td>
                                        <td>{{ post.description | shortlength(35,"...") }}</td>
                                        <td><img :src="ourImage(post.photo)" alt="" style="width: 100px;"></td>
                                        <td>
                                            <router-link :to="`/post-edit/${post.id}`" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></router-link>
                                            ||
                                            <a href="" @click.prevent="deletePost(post.id)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Sl</th>
                                        <th>User</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Photo</th>
                                        <th>Actions</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "list",
        mounted() {
            this.$store.dispatch("allPost");
        },
        computed: {
            getallPosts(){
                return this.$store.getters.getPost;
            }
        },
        methods: {
            ourImage(img){
                return "uploads/"+img;
            },
            
            deletePost(id)
            {
                axios.delete('/post_delete/'+id)
                    .then(()=>{
                        this.$store.dispatch("allPost");
                        Toast.fire({
                            type: 'success',
                            title: 'Post Delete successfully'
                        })
                    })
                    .catch(()=>{
        
                    });
            }
        }
    }
</script>

<style scoped>

</style>
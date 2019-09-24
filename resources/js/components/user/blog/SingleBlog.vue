<template>
    <span id="singleblog">
        <!-- end header -->
        <section id="inner-headline">
            <div class="container">
                <div class="row">
                    <div class="span4">
                        <div class="inner-heading">
                            <h2>Welcome to Blog</h2>
                        </div>
                    </div>
                    <div class="span8">
                        <ul class="breadcrumb">
                            <li><a href="#"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
                            <li><a href="#">Blog</a><i class="icon-angle-right"></i></li>
                            <li class="active">Blog with DevAminur</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="content">
          <div class="container">
            <div class="row">
              <div class="span8">
                
                <article>
                  <div class="row">
                    <div class="span8">
                      <div class="post-image">
                        <div class="post-heading">
                          <h3><a href="#">{{ getSinglePostById.title }}</a></h3>
                        </div>
                        <img :src="`uploads/${getSinglePostById.photo}`" alt="" style="width: 870px;height: 350px;"/>
                      </div>
                      <p>
                        {{ getSinglePostById.description }}
                      </p>
                      
                      <div class="bottom-article">
                        <ul class="meta-post">
                          <li><i class="icon-calendar"></i><a href="#"> {{ getSinglePostById.created_at | timeformat}}</a></li>
                          <li v-if="getSinglePostById.user"><i class="icon-user"></i><a href="#"> {{ getSinglePostById.user.name}}</a></li>
                          <li v-if="getSinglePostById.category"><i class="icon-folder-open"></i><a href="#"> {{ getSinglePostById.category.cat_name}}</a></li>
                          
                        </ul>
                      </div>
                    </div>
                  </div>
                </article>
              </div>
              <BlogSidebar/>
            </div>
          </div>
        </section>
    </span>
</template>

<script>
    import BlogSidebar from "./BlogSidebar.vue";
    export default {
        name: "single-blog",
        components:{
            BlogSidebar
        },
        mounted(){
            this.singlePost();
        },
        computed: {
            getSinglePostById(){
                return this.$store.getters.getSinglePost;
            }
        },
        methods: {
            singlePost(){
                this.$store.dispatch("allSingleBlog",this.$route.params.blogid);
            }
        },
        watch: {
            $route(to,from){
                this.singlePost();
            }
        }
    }
</script>

<style scoped>

</style>
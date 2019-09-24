<template>
    <span id="blogpost">
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
                        
                        <article v-for="bpost in blogPost" :key="bpost.id">
                            <div class="row">
                                <div class="span8">
                                    <div class="post-image">
                                        <div class="post-heading">
                                            <h3><router-link :to="`/singleblog/${bpost.id}`">{{ bpost.title }}</router-link></h3>
                                        </div>
                                        <img :src="`uploads/${bpost.photo}`" alt="" style="width: 870px; height: 350px"/>
                                    </div>
                                    <p>
                                        {{ bpost.description | shortlength(150,'...')}}
                                    </p>
                                    <div class="bottom-article">
                                        <ul class="meta-post">
                                            <li><i class="icon-calendar"></i><a href="#"> {{ bpost.created_at | timeformat}}</a></li>
                                            <li v-if="bpost.user"><i class="icon-user"></i><a href="#"> {{ bpost.user.name}}</a></li>
                                            <li v-if="bpost.category"><i class="icon-folder-open"></i><a href="#"> {{ bpost.category.cat_name}}</a></li>
                                            <li><i class="icon-comments"></i><a href="#">4 Comments</a></li>
                                        </ul>
                                        <router-link :to="`/singleblog/${bpost.id}`" class="pull-right">Continue reading <i class="icon-angle-right"></i></router-link>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <div id="pagination">
                            <span class="all">Page 1 of 3</span>
                            <span class="current">1</span>
                            <a href="#" class="inactive">2</a>
                            <a href="#" class="inactive">3</a>
                        </div>
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
        name: "blog-post",
        components:{
            BlogSidebar
        },
        mounted(){
            this.$store.dispatch("allBlogPost");
        },
        computed: {
            blogPost(){
                return this.$store.getters.getBlogPost;
            }
        },
        methods: {
            getAllCategoryPost(){
                if (this.$route.params.blogid != null) {
                    this.$store.dispatch("getPostByCatId", this.$route.params.blogid);
                }else {
                    this.$store.dispatch("allBlogPost");
                }
            }
        },
        watch: {
            $route(to,from){
                this.getAllCategoryPost();
            }
        }
    }
</script>

<style scoped>

</style>
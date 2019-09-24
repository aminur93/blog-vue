import AdminHome from './components/admin/AdminHome.vue';
import UserHome from './components/user/UserHome.vue';

//blog router
import BlogPost from './components/user/blog/BlogPost.vue';
import SingleBlogPost from './components/user/blog/SingleBlog.vue';

//category Router
import CategoryList from './components/admin/category/List.vue';
import CategoryNew from './components/admin/category/New.vue';
import CategoryEdit from './components/admin/category/Edit.vue';

//post Router
import PostList from './components/admin/post/Post_List.vue';
import PostNew from './components/admin/post/Post_New.vue';
import PostEdit from './components/admin/post/Post_Edit.vue';

export let routes = [
    {
        path: '/home',
        component: AdminHome
    },
    
    //category path
    {
        path: '/category-list',
        component: CategoryList
    },
    {
        path: '/category-new',
        component: CategoryNew
    },
    {
        path: '/category-edit/:categoryid',
        component: CategoryEdit
    },
    
    //post path
    {
        path: '/post-list',
        component: PostList
    },
    {
        path: '/post-new',
        component: PostNew
    },
    {
        path: '/post-edit/:postid',
        component: PostEdit
    },
    
    
    //User Rotes
    {
        path: '/',
        component: UserHome
    },
    {
        path: '/blog',
        component: BlogPost
    },
    
    {
        path: '/singleblog/:blogid',
        component: SingleBlogPost
    },
    
    {
        path: '/categoryblog/:blogid',
        component: BlogPost
    }
    
];
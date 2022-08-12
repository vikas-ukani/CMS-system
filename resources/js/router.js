import { createWebHistory, createRouter } from "vue-router";
import AllPages from "./components/pages/AllPages.vue"
import CreatePage from "./components/pages/CreatePage.vue"
import EditPage from "./components/pages/Edit.vue"
import NestedView from "./components/pages/NestedView.vue"


const nestedRoute = (name, path, component) => {
    return { name, path, component }
}

const routes = [
    nestedRoute('pages', "/", AllPages),
    nestedRoute('create', "/create", CreatePage),
    nestedRoute('edit', "/edit/:id", EditPage),
    {
        ...nestedRoute('nested', "/pages/", NestedView),
        children: [{
            ...nestedRoute('page1', ":page1/", NestedView),
            children: [{
                ...nestedRoute('page2', ":page2/", NestedView),
                children: [{
                    ...nestedRoute('page3', ":page3/", NestedView),
                    children: [{
                        ...nestedRoute('page4', ":page4/", NestedView),
                        children: [{
                            ...nestedRoute('page5', ":page5/", NestedView),
                            children: [{
                                ...nestedRoute('page6', ":page6/", NestedView),
                                children: [{
                                    ...nestedRoute('page7', ":page7/", NestedView),
                                    children: [{
                                        ...nestedRoute('page8', ":page8/", NestedView),
                                        children: [{
                                            ...nestedRoute('page9', ":page9/", NestedView),
                                            children: [{ 
                                                ...nestedRoute('page10', ":page10/", NestedView),
                                            }]
                                        }]
                                    }]
                                }]
                            }]
                        }]
                    },]
                }]
            }]
        }]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;

<template>
    <div class="d-flex mb-3 mt-5 justify-content-between">
        <h3 class="">All Pages</h3>
        <router-link :to="{ name: 'create' }" class="btn btn-dark right">
            <span class="text-decoration-underline "> Create Page</span>
        </router-link>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Parent Page</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="pages.length === 0">
                <td colspan="7" class="text-center text-muted fs-5"> No pages found, Please create any page.</td>
            </tr>
            <tr v-else-if="pages && pages.length > 0" v-for="(page, index) in pages" :key="page.slug">
                <td>{{ ++index }}</td>
                <td>{{ page.title }}</td>
                <td>{{ page.slug }}</td>
                <td>{{ page.parent?.title || '-' }}</td>
                <td>{{ page.created_at || '-' }}</td>
                <td>{{ page.updated_at || '-' }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{ name: 'edit', params: { id: page.slug } }" class="btn btn-primary">
                            Edit
                        </router-link>
                        <router-link :to="{ path: page.route }" class="btn btn-info">
                            View
                        </router-link>
                        <button class="btn btn-danger" @click="deletePage(page.slug)">
                            Delete
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import { API_URL } from '../../utils'
import axios from 'axios';

export default {
    name: "AllPages",
    data() {
        return {
            pages: [],
        }
    },

    created() {
        axios
            .get(`${API_URL}/pages`)
            .then(res => {
                res = res.data
                if (res.success) {
                    this.pages = res.data.map(list => {
                        return { ...list, route: `/pages/${this.recursiveGetRoute(list)}` }
                    })
                }
            })
            .catch(e => {
                console.log('e::', e);
                alert("Error found: See console logs");
                console.log('e.response.data::', e.response?.data);
            })
    },
    methods: {
        deletePage(slug) {
            if (confirm("Are you sure you want to delete this page?")) {
                axios.delete(`${API_URL}/pages/${slug}`)
                    .then(res => {
                        res = res.data
                        if (res.success) {
                            alert(res.message)
                            this.$router.go()
                        } else {
                            alert("ERROR: Open console")
                            console.log('res.message::', res?.message);
                        }
                    })
                    .catch(err => {
                        alert("ERROR: Open console")
                        console.log('res.message::', err);
                    })
            }
        },

        /**
         * Getnerate Route, Ex. page1/page2/page3/page4/page5/.....
         */
        recursiveGetRoute(obj) {
            let path = obj.slug
            if (obj.parent) path = this.recursiveGetRoute(obj.parent) + "/" + path
            return path;
        }
    }
};
</script>

<style>
</style>

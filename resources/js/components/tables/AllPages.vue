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
            <tr v-if="pages && pages.length" v-for="(page, index) in pages" :key="page.slug">
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

export default {
    name: "AllPages",
    data() {
        return {
            pages: [],
            tableData: [
                {
                    name: 'Ziuta', surname: 'Kozak', children: [
                        { name: 'Czerwony Kapturek', surname: 'Kozak' }
                    ]
                },
                {
                    name: 'Koziolek', surname: 'Matolek', children: [
                        { name: 'Timon', surname: 'Matolek', children: [{ name: 'Timon Junior', surname: 'Matolek' }] }
                    ]
                },
                { name: 'Pumba', surname: 'unknown' }
            ],
            columns: [{ label: 'Name', id: 'name' }, { label: 'Surname', id: 'surname' }]

        }
    },

    created() {
        axios
            .get(`${API_URL}/pages`)
            .then(res => {
                res = res.data
                if (res.success) {
                    this.pages = res.data
                }
            })
            .catch(e => {
                alert("Error found: See console logs");
                console.log('e.response.data::', e.response.data);
            })
        // this.getPages()
    },
    methods: {
        deletePage(slug) {
            console.log('id::', slug);
        }
    }
};
import axios from 'axios';
</script>

<style>
</style>

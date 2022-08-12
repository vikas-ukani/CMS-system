<template>
  <div class="my-5">
    <div class="d-flex mb-3 mt-5 justify-content-between">
      <h3 class="">Update Page - {{ this.page.title }}</h3>
      <router-link :to="{ name: 'pages' }" class="btn btn-warning">
        <span class="text-decoration-underline "> Back to list</span>
      </router-link>
    </div>
    <form @submit.prevent="onSubmit">
      <div class="errors" v-if="errors">
        <ul>
          <div v-for="(error, idx) in errors" :key="idx">
            <li class="text-danger">{{ error[0] }}</li>
          </div>
        </ul>
      </div>

      <div class="form-group" :class="{ error: v$.page.title.$errors.length }">
        <label for="title" class="form-label">Page title *</label>
        <input class="form-control" placeholder="Enter page title" type="text" v-model="v$.page.title.$model"
          @input="setTitle">
        <!-- error message -->
        <div class="input-errors" v-for="error of v$.page.title.$errors" :key="error.$uid">
          <div class="error-msg text-danger">{{ error.$message }}</div>
        </div>
      </div>

      <div class="mb-3 mt-4">
        <label for="slug" class="form-label">Page slug</label>
        <input type="text" v-model="page.slug" class="form-control" id="slug" placeholder="Enter page slug here"
          readonly disabled>
      </div>

      <div class="mb-3 mt-4">
        <label for="parentPage" class="form-label">Parent Page</label>
        <v-select v-model="page.parent_id" :reduce="(option) => option.id" :options="parentPages"
          placeholder="Select parent page." :value="page.parent_id" />
      </div>

      <div class="form-group" :class="{ error: v$.page.content.$errors.length }">
        <label for="content" class="form-label">Page Content *</label>
        <ckeditor tag-name="textarea" ref="cktext" :editor="editor" v-model="v$.page.content.$model"
          :config="editorConfig">
        </ckeditor>
        <!-- error message -->
        <div class="input-errors" v-for="error of v$.page.content.$errors" :key="error.$uid">
          <div class="error-msg text-danger">{{ error.$message }}</div>
        </div>
      </div>

      <div class="buttons-w mt-5 d-flex justify-content-between">
        <router-link :to="{ name: 'pages' }" class="btn btn-warning">
          Cancel
        </router-link>
        <button :disabled="v$.page.$invalid" class="btn btn-success ml-3">Save Page</button>
      </div>
    </form>
  </div>
</template>
<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import useVuelidate from '@vuelidate/core'
import { required, minLength, helpers } from '@vuelidate/validators'
import { API_URL } from '../../utils'
import axios from 'axios';
import vSelect from 'vue-select';

/** Search select dropdown field css */
export default {
  name: "Edit",
  components: {
    vSelect
  },

  setup() {
    return { v$: useVuelidate() }
  },

  created: function () {
    let { id } = this.$route.params
    axios.get(`${API_URL}/pages/${id}`)
      .then(res => {
        res = res.data
        if (res.success) {
          this.mainSlug = id
          this.page = res.data
          console.log('this.page::', this.page);
        } else {
          console.log('res.message::', res.message);
          if (res?.message) alert("Error: " + res.message)
        }
      })
      .catch(e => {
        alert("Error Found: Open console to see logs")
        console.log('ERROR::', e.response.error.message);
      })

    /** Get parent pages */
    axios.get(`${API_URL}/pages`)
      .then(res => {
        res = res.data
        if (res.success) this.parentPages = res.data.map(list => ({ id: list.id, label: list.title })).filter(list => list.id !== this.page.id)
        else this.parentPages = []
      })
  },

  data() {
    return {
      mainSlug: "",
      editor: ClassicEditor,
      editorConfig: {}, // Content editor config
      parentPages: [],
      page: {
        id: null,
        title: '',
        slug: '',
        content: '<p></p>',
        parent_id: null
      },
      errors: []
    }
  },

  validations() {
    return {
      page: {
        title: {
          // required
          required: helpers.withMessage('Page title field is required', required)
        },
        content: {
          required: helpers.withMessage('Page content field is required', required),
          min: minLength(6)
        },
      },
    }
  },

  methods: {
    onSubmit(e) {
      e.preventDefault();
      if (!this.mainSlug || this.mainSlug == "") {
        alert("Page Details not found");
        return false;
      }
      let { created_at, updated_at, ...rest } = this.page
      axios.put(`${API_URL}/pages/${this.mainSlug}`, rest)
        .then(res => {
          res = res.data
          if (res.success) {
            alert(res.message)
            this.$router.push('/')
          } else {
            alert("Error found")
            console.log('res.message::', res.message);
          }
        })
        .catch(e => {
          console.log('e.response::', e.response);
          let errors = e.response?.data?.errors
          if (errors) {
            this.errors = errors
          }
        })
    },
    setTitle($event) {
      // Convert title to slug field
      this.page.slug = $event.target.value.trim().toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '')
    }
  },
} 
</script>

<style>
</style>
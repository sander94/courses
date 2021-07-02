import CKEditor from '@ckeditor/ckeditor5-vue';

Nova.booting((Vue, router, store) => {
    Vue.use(CKEditor)

    Vue.component('index-ckeditor5-classic-field', require('./components/IndexField'))
    Vue.component('detail-ckeditor5-classic-field', require('./components/DetailField'))
    Vue.component('form-ckeditor5-classic-field', require('./components/FormField'))
})

<template>
    <Head :title="title"></Head>
    <AppSectionHeader :title="title" :bread-crumb="breadCrumb">
    </AppSectionHeader>

    <AppCard class="w-full md:w-3/4 xl:w-1/2">
        <template #title> {{ title }} </template>
        <template #content>
            <AppFormErrors class="mb-4" />
            <form>
                <div>
                    <AppLabel for="title">{{ __('Title') }}</AppLabel>
                    <AppInputText
                        id="title"
                        v-model="form.title"
                        type="text"
                        :class="{
                            'input-error': errorsFields.includes('title')
                        }"
                    />
                    <AppLabel for="description">{{ __('Description') }}</AppLabel>
                    <AppInputText
                        id="description"
                        v-model="form.description"
                        type="text"
                        :class="{
                            'input-error': errorsFields.includes('description')
                        }"
                    />
                </div>
            </form>
        </template>
        <template #footer>
            <AppButton class="btn btn-primary" @click="submitForm">
                {{ __('Save') }}
            </AppButton>
        </template>
    </AppCard>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3'
import useTitle from '@/Composables/useTitle'
import useFormContext from '@/Composables/useFormContext'
import useFormErrors from '@/Composables/useFormErrors'

const { title } = useTitle('Project')

const props = defineProps({
  project: {
    type: Object,
    default: null
  }
})

const breadCrumb = [
  { label: 'Home', href: route('dashboard.index') },
  { label: 'Projects', href: route('project.index') },
  { label: 'Project', last: true }
]

const form = useForm({
  title: props.project ? props.project.title : '',
  description: props.project ? props.project.description : '',
})

const { isCreate, isEdit } = useFormContext()

const submitForm = () => {
  if (isCreate.value) {
    form.post(route('project.store'))
  } 

  if(isEdit.value) {
    form.put(route('project.update', props.project.id))
  }
}

const { errorsFields } = useFormErrors()
</script>

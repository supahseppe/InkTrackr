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
                    <AppLabel for="count">{{ __('Word Count') }}</AppLabel>
                    <AppInputText
                        id="count"
                        v-model="form.count"
                        type="text"
                        :class="{
                            'input-error': errorsFields.includes('count')
                        }"
                    />
                    <AppLabel for="date">{{ __('Log Date') }}</AppLabel>
                    <AppInputText
                        id="date"
                        v-model="form.date"
                        type="text"
                        :class="{
                            'input-error': errorsFields.includes('date')
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

const { title } = useTitle('Progress')

const props = defineProps({
  progress: {
    type: Object,
    default: null
  }
})

const breadCrumb = [
  { label: 'Home', href: route('dashboard.index') },
  { label: 'Progress', href: route('progress.index') },
  { label: 'Progress', last: true }
]

const form = useForm({
  count: props.progress ? props.progress.count : 0,
  date: props.progress ? props.progress.date : Date.now(),
})

const { isCreate, isEdit } = useFormContext()

const submitForm = () => {
  if (isCreate.value) {
    form.post(route('progress.store'))
  } 

  if(isEdit.value) {
    form.put(route('progress.update', props.progress.id))
  }
}

const { errorsFields } = useFormErrors()
</script>

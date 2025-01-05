<template>
    <Head title="Login"></Head>
    <AppAuthShell>
        <AppAuthLogo />
        <AppCard class="space-y-2 w-80 bg-skin-neutral-2">
            <template #content>
                <div class="flex flex-row justify-around">
                    <a href="/login/social">
                        <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">{{ __('Log In with Discord') }}</button>
                    </a>
                </div>
            </template>
        </AppCard>
    </AppAuthShell>
</template>

<script>
import GuestLayout from '@/Layouts/GuestLayout.vue'
export default {
    layout: GuestLayout
}
</script>

<script setup>
import { Head } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import useFormErrors from '@/Composables/useFormErrors'

const form = useForm({
    email: '',
    password: '',
    remember: false
})

function submitForm() {
    form.post(route('adminAuth.login'))
}

const { errorsFields } = useFormErrors()
</script>

<template>
    <Head :title="title"></Head>
    <AppSectionHeader :title="title" :bread-crumb="breadCrumb">
        <template #right>
            <AppButton
                class="btn btn-primary"
                @click="$inertia.visit(route('project.create'))"
            >
                <i class="mr-1 ri-add-fill"></i>
                Create Project
            </AppButton>
        </template>
    </AppSectionHeader>

    <AppDataSearch
        v-if="projects.data.length || route().params.searchTerm"
        :url="route('project.index')"
        fields-to-search="id"
    ></AppDataSearch>

    <AppDataTable v-if="projects.data.length" :headers="headers">
        <template #TableBody>
            <tbody>
                <AppDataTableRow
                    v-for="(item, index) in projects.data"
                    :key="item.id"
                >
                    <AppDataTableData>
                        {{ item.id }}
                    </AppDataTableData>

                    <AppDataTableData>
                        {{ item.title }}
                    </AppDataTableData>
                    
                    <AppDataTableData>
                        {{ item.description }}
                    </AppDataTableData>
                    
                    <AppDataTableData>
                        {{ item.created_at }}
                    </AppDataTableData>

                    <AppDataTableData>
                        <!-- Edit project -->
                        <AppTooltip text="Edit Project" class="mr-2">
                            <AppButton
                                class="btn btn-icon btn-primary"
                                @click="
                                    $inertia.visit(
                                        route(
                                            'project.edit',
                                            item.id
                                        )
                                    )
                                "
                            >
                                <i class="ri-edit-line"></i>
                            </AppButton>
                        </AppTooltip>

                        <!-- Delete project -->
                        <AppTooltip text="Delete Project">
                            <AppButton
                                class="btn btn-icon btn-destructive"
                                @click="
                                    confirmDelete(
                                        route(
                                            'project.destroy',
                                            item.id
                                        )
                                    )
                                "
                            >
                                <i class="ri-delete-bin-line"></i>
                            </AppButton>
                        </AppTooltip>
                    </AppDataTableData>
                </AppDataTableRow>
            </tbody>
        </template>
    </AppDataTable>

    <AppPaginator
        :links="projects.links"
        :from="projects.from || 0"
        :to="projects.to || 0"
        :total="projects.total || 0"
        class="justify-center mt-4"
    ></AppPaginator>

    <AppAlert v-if="!projects.data.length" class="mt-4">
        No projects found.
    </AppAlert>

    <AppConfirmDialog ref="confirmDialogRef"></AppConfirmDialog>
</template>

<script setup>
import { ref } from 'vue'
import { Head } from '@inertiajs/vue3'
import useTitle from '@/Composables/useTitle'
import useAuthCan from '@/Composables/useAuthCan'

const { title } = useTitle('Project')
const { can } = useAuthCan()

const props = defineProps({
  projects: {
    type: Object,
    default: () => {}
  }
})

const breadCrumb = [
  { label: 'Home', href: route('dashboard.index') },
  { label: 'Projects', last: true }
]

const headers = ['ID', 'Title', 'Description', 'Created', 'Actions']

const confirmDialogRef = ref(null)
const confirmDelete = (deleteRoute) => {
    confirmDialogRef.value.openModal(deleteRoute)
}
</script>

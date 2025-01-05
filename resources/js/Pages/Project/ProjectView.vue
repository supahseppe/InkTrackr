<template>
    <Head :title="title"></Head>
    <AppSectionHeader :title="title" :bread-crumb="breadCrumb">
        <template #right>
            <AppButton
                class="btn btn-primary"
                @click="$inertia.visit(route('project.edit', project.id))"
            >
                <i class="mr-1 ri-add-fill"></i>
                Edit Project
            </AppButton>
        </template>
    </AppSectionHeader>

    <pre>
        {{ project }}
    </pre>

    <div class="max-w-xl min-w-full">
        <Line :data="lineData" :options="lineOptions" />
    </div>

    <AppButton
        class="btn btn-primary"
        @click="$inertia.visit(route('progress.create', project.id))"
    >
        <i class="ri-add-fill"></i>
        Add Progress
    </AppButton>

    <AppConfirmDialog ref="confirmDialogRef"></AppConfirmDialog>
</template>

<script setup>
import { ref } from 'vue'
import { Head } from '@inertiajs/vue3'
import useTitle from '@/Composables/useTitle'
import useAuthCan from '@/Composables/useAuthCan'
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
} from 'chart.js'
import { Line } from 'vue-chartjs'
import { format, parse } from "@formkit/tempo"

const { title } = useTitle('Project')
const { can } = useAuthCan()

const props = defineProps({
  project: {
    type: Object,
    default: () => {}
  }
})

const breadCrumb = [
  { label: 'Home', href: route('dashboard.index') },
  { label: 'Projects', href: route('project.index') },
  { label: props.project.title, last: true }
]

const confirmDialogRef = ref(null)
const confirmDelete = (deleteRoute) => {
    confirmDialogRef.value.openModal(deleteRoute)
}

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
)

const labels = [];
const counts = [];
props.project.progress.forEach(item => {
    const date = format(item.date, {date: "full", time: "short"});
    labels.push(date);
    const count = item.count;
    counts.push(count);
});

const lineData = {
  labels: labels,
  datasets: [
    {
      label: 'Word Count',
      backgroundColor: '#f87979',
      data: counts
    }
  ]
};

const lineOptions = {
  responsive: true,
  maintainAspectRatio: true
};

</script>

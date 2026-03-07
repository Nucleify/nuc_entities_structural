<!--suppress HtmlUnknownAnchorTarget -->
<template>
  <div class="panel-container">
    <nuc-tiles :entities="entities" />

    <nuc-entity-chart-card
      entity="Structural"
      class="annual-chart-card"
      chart-method-type="annual"
      type="bar"
      :direction="isMobile() ? 'horizontal' : 'vertical'"
      :data="{ 
        card: cards, 
        link: links, 
        question: questions, 
        technology: technologies, 
        feature: features 
      }"
      :loading="!allLoaded"
    />

    <nuc-question-dashboard
      :data="questions"
      :get-data="getAllQuestions"
      :loading="!allLoaded"
    />
    <nuc-technology-dashboard
      :data="technologies"
      :get-data="getAllTechnologies"
      :loading="!allLoaded"
    />
  </div>
</template>

<script setup lang="ts">
import { useRoute } from 'nuxt/app'
import { useI18n } from 'vue-i18n'

import type { TileInterface } from 'nucleify'
import { questionRequests, technologyRequests } from 'nucleify'

const route = useRoute()
const { t } = useI18n()
const lang = computed(() => (route.params.lang as string) || 'en')

const {
  results: questions,
  createdLastWeek: questionsCreatedLastWeek,
  loading: questionsLoading,
  getAllQuestions,
  getCountQuestionsByCreatedLastWeek,
} = questionRequests()

const {
  results: technologies,
  createdLastWeek: technologiesCreatedLastWeek,
  loading: technologiesLoading,
  getAllTechnologies,
  getCountTechnologiesByCreatedLastWeek,
} = technologyRequests()

onMounted(() => {
  getAllQuestions(true)
  getCountQuestionsByCreatedLastWeek()
  getAllTechnologies(true)
  getCountTechnologiesByCreatedLastWeek()
})

const allLoaded: Ref<boolean> = ref(false)

watch(
  [questionsLoading, technologiesLoading],
  ([questionsLoading, technologiesLoading]: [boolean, boolean]) => {
    if (!questionsLoading && !technologiesLoading) {
      setTimeout(() => {
        allLoaded.value = true
      }, 200)
    }
  }
)

const entities = computed<TileInterface[]>(() => [
  {
    href: `/${lang.value}/structural/questions`,
    header: t('admin-tile-questions'),
    count: questions.value?.length || 0,
    icon: 'prime:question',
    countSecondary: questionsCreatedLastWeek.value,
    textSecondary: t('admin-tile-this-week'),
    adType: 'question',
  },
  {
    href: `/${lang.value}/structural/technologies`,
    header: t('admin-tile-technologies'),
    count: technologies.value?.length || 0,
    icon: 'prime:microchip-ai',
    countSecondary: technologiesCreatedLastWeek.value,
    textSecondary: t('admin-tile-this-week'),
    adType: 'technology',
  },
])
</script>

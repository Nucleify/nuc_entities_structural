<template>
  <section id="questions">
    <nuc-entity-datatable-card
      :value="data"
      :loading="loading"
      :open-dialog="openDialog"
      :tag="3"
      ad-type="technology"
      :header-text="t('entity-technology-manage')"
      :button-text="t('entity-technology-new')"
    />

    <nuc-dialog
      v-for="dialog in dialogs"
      :key="dialog.action"
      :entity="dialog.entity"
      :action="dialog.action"
      :visible="dialog.visible"
      :selected-object="selectedObject"
      :title="dialog.title"
      :fields="dialog.fields"
      :confirm-button-label="dialog.confirmButtonLabel"
      :cancel-button-label="dialog.cancelButtonLabel"
      :confirm="dialog.confirm"
      :get-data="dialog.getData"
      :close="closeDialog"
    />
  </section>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { useI18n } from 'vue-i18n'

import type { NucDashboardInterface } from 'nucleify'
import { technologyRequests, useNucDialog, useTechnologyFields } from 'nucleify'

const props = defineProps<NucDashboardInterface>()
const { t } = useI18n()

const {
  visibleShow,
  visibleCreate,
  visibleEdit,
  visibleDelete,
  selectedObject,
  openDialog,
  closeDialog,
} = useNucDialog()

const { createAndEditFields, showFields } = useTechnologyFields()
const { deleteTechnology, storeTechnology, editTechnology } =
  technologyRequests(closeDialog)

const dialogs = computed(() => [
  {
    entity: 'technology',
    action: 'show',
    visible: visibleShow.value,
    data: selectedObject.value,
    cancelButtonLabel: t('common-close'),
    fields: showFields,
  },
  {
    entity: 'technology',
    action: 'delete',
    visible: visibleDelete.value,
    selectedObject: selectedObject.value,
    title: t('entity-technology-delete'),
    confirmButtonLabel: t('common-confirm'),
    cancelButtonLabel: t('common-cancel'),
    confirm: deleteTechnology,
    getData: props.getData,
  },
  {
    entity: 'technology',
    action: 'create',
    visible: visibleCreate.value,
    title: t('entity-technology-create'),
    confirmButtonLabel: t('common-confirm'),
    cancelButtonLabel: t('common-cancel'),
    confirm: storeTechnology,
    getData: props.getData,
    fields: createAndEditFields,
  },
  {
    entity: 'technology',
    action: 'edit',
    visible: visibleEdit.value,
    data: selectedObject.value,
    title: t('entity-technology-edit'),
    confirmButtonLabel: t('common-update'),
    cancelButtonLabel: t('common-cancel'),
    confirm: editTechnology,
    getData: props.getData,
    fields: createAndEditFields,
  },
])
</script>

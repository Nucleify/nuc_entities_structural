'use client'

import { useMemo } from 'react'
import { useTranslation } from 'react-i18next'

import type { NucQuestionObjectInterface } from 'nucleify'
import {
  type ConfirmDialogFunctionType,
  type NucDashboardInterface,
  NucDialog,
  NucEntityDataTableCard,
  questionRequests,
  useNucDialog,
  useQuestionFields,
} from 'nucleify'

type QuestionDashboardProps = Omit<NucDashboardInterface, 'data'> & {
  data: NucQuestionObjectInterface[]
}

export function NucQuestionDashboard({
  data,
  getData,
  loading,
}: QuestionDashboardProps): React.JSX.Element {
  const { t } = useTranslation()

  const {
    visibleShow,
    visibleCreate,
    visibleEdit,
    visibleDelete,
    selectedObject,
    openDialog,
    closeDialog,
  } = useNucDialog()

  const { createAndEditFields, showFields } = useQuestionFields()
  const { deleteQuestion, storeQuestion, editQuestion } = questionRequests(
    closeDialog,
    'next'
  )

  const confirmCreate: ConfirmDialogFunctionType = async (data, getData) => {
    await storeQuestion(
      data as unknown as NucQuestionObjectInterface,
      async () => {
        getData?.()
      }
    )
  }

  const confirmEdit: ConfirmDialogFunctionType = async (data, getData) => {
    await editQuestion(
      data as unknown as NucQuestionObjectInterface,
      async () => {
        getData?.()
      }
    )
  }

  const confirmDelete: ConfirmDialogFunctionType = async (id, getData) => {
    if (typeof id !== 'number') return
    await deleteQuestion(id, async () => {
      getData?.()
    })
  }

  const dialogs = useMemo(
    () => [
      {
        entity: 'question',
        action: 'show',
        visible: visibleShow,
        data: selectedObject ? [selectedObject] : undefined,
        cancelButtonLabel: t('common-close'),
        fields: showFields as unknown as Array<{
          name: string
          label: string
          type: string
          key: string
          props?: Record<string, unknown>
        }>,
      },
      {
        entity: 'question',
        action: 'delete',
        visible: visibleDelete,
        title: t('entity-question-delete'),
        confirmButtonLabel: t('common-confirm'),
        cancelButtonLabel: t('common-cancel'),
        confirm: confirmDelete,
        getData: getData,
      },
      {
        entity: 'question',
        action: 'create',
        visible: visibleCreate,
        title: t('entity-question-create'),
        confirmButtonLabel: t('common-confirm'),
        cancelButtonLabel: t('common-cancel'),
        confirm: confirmCreate,
        getData: getData,
        fields: createAndEditFields as unknown as Array<{
          name: string
          label: string
          type: string
          key: string
          props?: Record<string, unknown>
        }>,
      },
      {
        entity: 'question',
        action: 'edit',
        visible: visibleEdit,
        data: selectedObject ? [selectedObject] : undefined,
        title: t('entity-question-edit'),
        confirmButtonLabel: t('common-update'),
        cancelButtonLabel: t('common-cancel'),
        confirm: confirmEdit,
        getData: getData,
        fields: createAndEditFields as unknown as Array<{
          name: string
          label: string
          type: string
          key: string
          props?: Record<string, unknown>
        }>,
      },
    ],
    [
      createAndEditFields,
      confirmCreate,
      confirmDelete,
      confirmEdit,
      getData,
      selectedObject,
      showFields,
      t,
      visibleCreate,
      visibleDelete,
      visibleEdit,
      visibleShow,
    ]
  )

  return (
    <section id="questions">
      <NucEntityDataTableCard
        value={data}
        loading={loading}
        openDialog={openDialog}
        tag={3}
        adType="question"
        headerText={t('entity-question-manage')}
        buttonText={t('entity-question-new')}
      />

      {dialogs.map((dialog) => (
        <NucDialog
          key={dialog.action}
          entity={dialog.entity as ObjectNameType}
          action={dialog.action as ActionType}
          visible={dialog.visible}
          selectedObject={selectedObject as ObjectType}
          title={dialog.title}
          fields={dialog.fields}
          confirmButtonLabel={dialog.confirmButtonLabel}
          cancelButtonLabel={dialog.cancelButtonLabel}
          confirm={dialog.confirm}
          getData={dialog.getData}
          close={closeDialog}
          data={dialog.data as ObjectType[]}
          onHide={() => closeDialog(dialog.action as ActionType)}
        />
      ))}
    </section>
  )
}

'use client'

import { useMemo } from 'react'
import { useTranslation } from 'react-i18next'

import type { NucTechnologyObjectInterface } from 'nucleify'
import {
  type ConfirmDialogFunctionType,
  type NucDashboardInterface,
  NucDialog,
  NucEntityDataTableCard,
  technologyRequests,
  useNucDialog,
  useTechnologyFields,
} from 'nucleify'

type TechnologyDashboardProps = Omit<NucDashboardInterface, 'data'> & {
  data: NucTechnologyObjectInterface[]
}

export function NucTechnologyDashboard({
  data,
  getData,
  loading,
}: TechnologyDashboardProps): React.JSX.Element {
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

  const { createAndEditFields, showFields } = useTechnologyFields()
  const { deleteTechnology, storeTechnology, editTechnology } =
    technologyRequests(closeDialog, 'next')

  const confirmCreate: ConfirmDialogFunctionType = async (data, getData) => {
    await storeTechnology(
      data as unknown as NucTechnologyObjectInterface,
      async () => {
        getData?.()
      }
    )
  }

  const confirmEdit: ConfirmDialogFunctionType = async (data, getData) => {
    await editTechnology(
      data as unknown as NucTechnologyObjectInterface,
      async () => {
        getData?.()
      }
    )
  }

  const confirmDelete: ConfirmDialogFunctionType = async (id, getData) => {
    if (typeof id !== 'number') return
    await deleteTechnology(id, async () => {
      getData?.()
    })
  }

  const dialogs = useMemo(
    () => [
      {
        entity: 'technology',
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
        entity: 'technology',
        action: 'delete',
        visible: visibleDelete,
        title: t('entity-technology-delete'),
        confirmButtonLabel: t('common-confirm'),
        cancelButtonLabel: t('common-cancel'),
        confirm: confirmDelete,
        getData: getData,
      },
      {
        entity: 'technology',
        action: 'create',
        visible: visibleCreate,
        title: t('entity-technology-create'),
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
        entity: 'technology',
        action: 'edit',
        visible: visibleEdit,
        data: selectedObject ? [selectedObject] : undefined,
        title: t('entity-technology-edit'),
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
        value={data as Record<string, unknown>[] | undefined}
        loading={loading}
        openDialog={openDialog}
        tag={3}
        nuiType="technology"
        headerText={t('entity-technology-manage')}
        buttonText={t('entity-technology-new')}
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

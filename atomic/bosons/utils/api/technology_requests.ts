'use client'

import type {
  AppFramework,
  CloseDialogType,
  NucTechnologyObjectInterface,
  NucTechnologyRequestsInterface,
  UseLoadingInterface,
} from 'nucleify'
import {
  apiHandle,
  createEntityCollectionState,
  createEntityRequestState,
  createEntityRequestsCore,
  useApiSuccess,
  useLoading,
} from 'nucleify'

const TECHNOLOGIES_URL = '/technologies'

export function technologyRequests(
  close?: CloseDialogType,
  framework: AppFramework = 'nuxt'
): NucTechnologyRequestsInterface {
  const { results, createdLastWeek, setResults, setCreatedLastWeek } =
    createEntityRequestState<NucTechnologyObjectInterface>(framework)

  const { items: resultsByCategory, setItems: setResultsByCategory } =
    createEntityCollectionState<NucTechnologyObjectInterface>(framework)
  const { items: resultsBySite, setItems: setResultsBySite } =
    createEntityCollectionState<NucTechnologyObjectInterface>(framework)

  const { loading, setLoading }: UseLoadingInterface = useLoading()
  const { apiSuccess } = useApiSuccess()

  const { getAll, getCountByCreatedLastWeek, store, edit, remove } =
    createEntityRequestsCore<NucTechnologyObjectInterface>({
      baseUrl: TECHNOLOGIES_URL,
      close,
      apiSuccess,
      setResults,
      setCreatedLastWeek,
      setLoading,
    })

  async function getTechnologiesByCategory(
    category: string,
    showLoading?: boolean
  ): Promise<void> {
    await apiHandle<NucTechnologyObjectInterface[]>({
      url: `${TECHNOLOGIES_URL}/get-by-category/${category}`,
      setLoading: showLoading ? setLoading : undefined,
      onSuccess: setResultsByCategory,
    })
  }

  async function getSiteTechnologies(
    site: SiteType,
    showLoading?: boolean
  ): Promise<void> {
    await apiHandle<NucTechnologyObjectInterface[]>({
      url: `${TECHNOLOGIES_URL}/get-site-technologies/${site}`,
      setLoading: showLoading ? setLoading : undefined,
      onSuccess: setResultsBySite,
    })
  }

  return {
    results,
    resultsByCategory,
    resultsBySite,
    createdLastWeek,
    loading,
    getAllTechnologies: getAll,
    getCountTechnologiesByCreatedLastWeek: getCountByCreatedLastWeek,
    getTechnologiesByCategory,
    getSiteTechnologies,
    storeTechnology: store,
    editTechnology: edit,
    deleteTechnology: remove,
  }
}

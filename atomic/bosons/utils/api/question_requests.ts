'use client'

import type {
  AppFramework,
  CloseDialogType,
  NucQuestionObjectInterface,
  NucQuestionRequestsInterface,
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

const QUESTIONS_URL = '/questions'

export function questionRequests(
  close?: CloseDialogType,
  framework: AppFramework = 'nuxt'
): NucQuestionRequestsInterface {
  const { results, createdLastWeek, setResults, setCreatedLastWeek } =
    createEntityRequestState<NucQuestionObjectInterface>(framework)

  const { items: resultsByCategory, setItems: setResultsByCategory } =
    createEntityCollectionState<NucQuestionObjectInterface>(framework)
  const { items: resultsByLang, setItems: setResultsByLang } =
    createEntityCollectionState<NucQuestionObjectInterface>(framework)
  const { items: resultsBySite, setItems: setResultsBySite } =
    createEntityCollectionState<NucQuestionObjectInterface>(framework)

  const { loading, setLoading }: UseLoadingInterface = useLoading()
  const { apiSuccess } = useApiSuccess()

  const { getAll, getCountByCreatedLastWeek, store, edit, remove } =
    createEntityRequestsCore<NucQuestionObjectInterface>({
      baseUrl: QUESTIONS_URL,
      close,
      apiSuccess,
      setResults,
      setCreatedLastWeek,
      setLoading,
    })

  async function getQuestionsByCategory(
    category: string,
    showLoading?: boolean
  ): Promise<void> {
    await apiHandle<NucQuestionObjectInterface[]>({
      url: `${QUESTIONS_URL}/get-by-category/${category}`,
      setLoading: showLoading ? setLoading : undefined,
      onSuccess: (response) => {
        setResultsByCategory(response)
        apiSuccess(response)
      },
    })
  }

  async function getSiteQuestions(
    site: SiteType,
    showLoading?: boolean
  ): Promise<void> {
    await apiHandle<NucQuestionObjectInterface[]>({
      url: `${QUESTIONS_URL}/get-site-questions/${site}`,
      setLoading: showLoading ? setLoading : undefined,
      onSuccess: setResultsBySite,
    })
  }

  async function getSiteQuestionsByLang(
    site: SiteType,
    lang: string,
    showLoading?: boolean
  ): Promise<void> {
    await apiHandle<NucQuestionObjectInterface[]>({
      url: `${QUESTIONS_URL}/get-site-questions/${site}/${lang}`,
      setLoading: showLoading ? setLoading : undefined,
      onSuccess: setResultsByLang,
    })
  }

  return {
    results,
    resultsByCategory,
    resultsByLang,
    resultsBySite,
    createdLastWeek,
    loading,
    getAllQuestions: getAll,
    getCountQuestionsByCreatedLastWeek: getCountByCreatedLastWeek,
    getQuestionsByCategory,
    getSiteQuestions,
    getSiteQuestionsByLang,
    storeQuestion: store,
    editQuestion: edit,
    deleteQuestion: remove,
  }
}

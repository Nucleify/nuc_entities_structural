import type {
  EntityCountResultsType,
  EntityResultsType,
  LoadingType,
  NucQuestionObjectInterface,
} from 'nucleify'

export interface NucQuestionRequestsInterface {
  results: EntityResultsType<NucQuestionObjectInterface>
  resultsByCategory: EntityResultsType<NucQuestionObjectInterface>
  resultsByLang: EntityResultsType<NucQuestionObjectInterface>
  resultsBySite: EntityResultsType<NucQuestionObjectInterface>
  createdLastWeek: EntityCountResultsType
  loading: LoadingType
  getAllQuestions: (loading?: boolean) => Promise<void>
  getQuestionsByCategory: (category: string, loading?: boolean) => Promise<void>
  getSiteQuestions: (site: SiteType, loading?: boolean) => Promise<void>
  getSiteQuestionsByLang: (
    site: SiteType,
    lang: string,
    loading?: boolean
  ) => Promise<void>
  getCountQuestionsByCreatedLastWeek: () => Promise<void>
  storeQuestion: (
    data: NucQuestionObjectInterface,
    getData: () => Promise<void>
  ) => Promise<void>
  editQuestion: (
    data: NucQuestionObjectInterface,
    getData: () => Promise<void>
  ) => Promise<void>
  deleteQuestion: (id: number, getData: () => Promise<void>) => Promise<void>
}

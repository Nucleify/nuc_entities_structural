import type {
  EntityCountResultsType,
  EntityResultsType,
  LoadingType,
  NucTechnologyObjectInterface,
} from 'nucleify'

export interface NucTechnologyRequestsInterface {
  results: EntityResultsType<NucTechnologyObjectInterface>
  resultsByCategory: EntityResultsType<NucTechnologyObjectInterface>
  resultsBySite: EntityResultsType<NucTechnologyObjectInterface>
  createdLastWeek: EntityCountResultsType
  loading: LoadingType
  getAllTechnologies: (loading?: boolean) => Promise<void>
  getTechnologiesByCategory: (
    category: string,
    loading?: boolean
  ) => Promise<void>
  getSiteTechnologies: (site: SiteType, loading?: boolean) => Promise<void>
  getCountTechnologiesByCreatedLastWeek: () => Promise<void>
  storeTechnology: (
    data: NucTechnologyObjectInterface,
    getData: () => Promise<void>
  ) => Promise<void>
  editTechnology: (
    data: NucTechnologyObjectInterface,
    getData: () => Promise<void>
  ) => Promise<void>
  deleteTechnology: (id: number, getData: () => Promise<void>) => Promise<void>
}

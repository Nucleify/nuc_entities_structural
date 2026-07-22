'use client'

import { useParams } from 'next/navigation'
import { useEffect, useMemo, useState } from 'react'
import { useTranslation } from 'react-i18next'

import {
  isMobile,
  NucEntityChartCard,
  NucQuestionDashboard,
  NucTechnologyDashboard,
  NucTiles,
  type NucTilesInterface,
  questionRequests,
  technologyRequests,
} from 'nucleify'

export function NucStructuralPage(): React.JSX.Element {
  const params = useParams<{ lang?: string }>()
  const lang = params?.lang || 'en'
  const { t } = useTranslation()

  const {
    results: questions,
    createdLastWeek: questionsCreatedLastWeek,
    loading: questionsLoading,
    getAllQuestions,
    getCountQuestionsByCreatedLastWeek,
  } = questionRequests(undefined, 'next')

  const {
    results: technologies,
    createdLastWeek: technologiesCreatedLastWeek,
    loading: technologiesLoading,
    getAllTechnologies,
    getCountTechnologiesByCreatedLastWeek,
  } = technologyRequests(undefined, 'next')

  const [allLoaded, setAllLoaded] = useState<boolean>(false)

  useEffect(() => {
    void getAllQuestions(true)
    void getCountQuestionsByCreatedLastWeek()
    void getAllTechnologies(true)
    void getCountTechnologiesByCreatedLastWeek()
  }, [])

  useEffect(() => {
    if (!questionsLoading && !technologiesLoading) {
      const timeout = window.setTimeout(() => {
        setAllLoaded(true)
      }, 200)

      return () => {
        window.clearTimeout(timeout)
      }
    }

    setAllLoaded(false)
    return undefined
  }, [questionsLoading, technologiesLoading])

  const entities = useMemo<NucTilesInterface['entities']>(
    () => [
      {
        href: `/${lang}/structural/questions`,
        header: t('admin-tile-questions'),
        count: questions?.length || 0,
        icon: 'prime:question',
        countSecondary: questionsCreatedLastWeek,
        textSecondary: t('admin-tile-this-week'),
        nuiType: 'question',
      },
      {
        href: `/${lang}/structural/technologies`,
        header: t('admin-tile-technologies'),
        count: technologies?.length || 0,
        icon: 'prime:microchip-ai',
        countSecondary: technologiesCreatedLastWeek,
        textSecondary: t('admin-tile-this-week'),
        nuiType: 'technology',
      },
    ],
    [
      lang,
      questions,
      questionsCreatedLastWeek,
      t,
      technologies,
      technologiesCreatedLastWeek,
    ]
  )

  return (
    <div className="panel-container">
      <NucTiles entities={entities} />

      <NucEntityChartCard
        entity="Structural"
        chartClass="annual-chart-card"
        chartMethodType="annual"
        type="bar"
        direction={isMobile() ? 'horizontal' : 'vertical'}
        data={{
          question: questions,
          technology: technologies,
        }}
        loading={!allLoaded}
      />

      <NucQuestionDashboard
        data={questions ?? []}
        getData={getAllQuestions}
        loading={!allLoaded}
      />
      <NucTechnologyDashboard
        data={technologies ?? []}
        getData={getAllTechnologies}
        loading={!allLoaded}
      />
    </div>
  )
}

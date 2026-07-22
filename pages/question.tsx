'use client'

import { useEffect } from 'react'

import {
  isMobile,
  NucEntityChartCard,
  NucQuestionDashboard,
  questionRequests,
  useNucDialog,
} from 'nucleify'

export function NucQuestionPage(): React.JSX.Element {
  const { closeDialog } = useNucDialog()
  const { results, loading, getAllQuestions } = questionRequests(
    closeDialog,
    'next'
  )

  useEffect(() => {
    void getAllQuestions(true)
  }, [])

  return (
    <div className="panel-container">
      <NucEntityChartCard
        entity="Question"
        chartClass="annual-chart-card"
        chartMethodType="annual"
        type="bar"
        direction={isMobile() ? 'horizontal' : 'vertical'}
        data={{ question: results }}
        loading={loading}
      />
      <NucQuestionDashboard
        data={results ?? []}
        getData={getAllQuestions}
        loading={loading}
      />
    </div>
  )
}

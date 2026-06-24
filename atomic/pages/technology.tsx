'use client'

import { useEffect } from 'react'

import {
  isMobile,
  NucEntityChartCard,
  NucTechnologyDashboard,
  technologyRequests,
  useNucDialog,
} from 'nucleify'

export function NucTechnologyPage(): React.JSX.Element {
  const { closeDialog } = useNucDialog()
  const { results, loading, getAllTechnologies } = technologyRequests(
    closeDialog,
    'next'
  )

  useEffect(() => {
    void getAllTechnologies(true)
  }, [])

  return (
    <div className="panel-container">
      <NucEntityChartCard
        entity="Technology"
        chartClass="annual-chart-card"
        chartMethodType="annual"
        type="bar"
        direction={isMobile() ? 'horizontal' : 'vertical'}
        data={{ technology: results }}
        loading={loading}
      />
      <NucTechnologyDashboard
        data={results ?? []}
        getData={getAllTechnologies}
        loading={loading}
      />
    </div>
  )
}

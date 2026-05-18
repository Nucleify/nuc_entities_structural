import {
  apiMethodNotAllowed,
  apiNotHandled,
  tryGetEqRoutes,
  tryReadOnlyTable,
} from 'nuc_api'
import type { ApiContext, ApiHandlerResult } from 'nuc_server'
import { formatRowsResponseTimestamps } from 'nuc_server'

import {
  questionEqRoutes,
  STRUCTURAL_TABLES,
  technologyEqRoutes,
} from './structural_helpers'

export async function handleStructuralApi(
  ctx: ApiContext
): Promise<ApiHandlerResult> {
  const table = ctx.segments[0]
  if (!STRUCTURAL_TABLES.has(table)) return apiNotHandled()

  if (ctx.method === 'GET') {
    const custom = await tryGetEqRoutes(
      ctx,
      table === 'questions' ? questionEqRoutes : technologyEqRoutes
    )
    if (custom) return custom
  }

  const read = await tryReadOnlyTable(ctx, {
    table,
    formatRows: formatRowsResponseTimestamps,
  })
  return read ?? apiMethodNotAllowed()
}

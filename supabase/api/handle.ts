import type {
  ApiContext,
  ApiHandlerResult,
} from '../../../../nuxt/server/api/_types'
import { formatRowsResponseTimestamps } from '../../../../nuxt/server/api/format_timestamptz_response'

const supports = ['questions', 'technologies']

function oneWeekAgoIso(): string {
  const d = new Date()
  d.setDate(d.getDate() - 7)
  d.setHours(0, 0, 0, 0)
  return d.toISOString()
}

export async function handleStructuralApi(
  ctx: ApiContext
): Promise<ApiHandlerResult> {
  const { segments, method, supabase, ok } = ctx
  const table = segments[0]
  if (!supports.includes(table)) return { handled: false }

  if (method === 'GET' && table === 'questions') {
    if (segments[1] === 'get-site-questions' && segments.length === 3) {
      const site = segments[2]
      const { data, error } = await supabase
        .from('questions')
        .select('*')
        .eq('category', site)
        .order('index', { ascending: true })
      if (error)
        return { handled: true, status: 500, body: { error: error.message } }
      return { handled: true, body: ok(data || []) }
    }
    if (segments[1] === 'get-site-questions' && segments.length === 4) {
      const site = segments[2]
      const lang = segments[3]
      const { data, error } = await supabase
        .from('questions')
        .select('*')
        .eq('category', site)
        .eq('lang', lang)
        .order('index', { ascending: true })
      if (error)
        return { handled: true, status: 500, body: { error: error.message } }
      return { handled: true, body: ok(data || []) }
    }
    if (segments[1] === 'get-by-category' && segments.length === 3) {
      const category = segments[2]
      const { data, error } = await supabase
        .from('questions')
        .select('*')
        .eq('category', category)
        .order('index', { ascending: true })
      if (error)
        return { handled: true, status: 500, body: { error: error.message } }
      return { handled: true, body: ok(data || []) }
    }
    if (segments[1] === 'count-by-created-last-week' && segments.length === 2) {
      const { count, error } = await supabase
        .from('questions')
        .select('*', { count: 'exact', head: true })
        .gte('created_at', oneWeekAgoIso())
      if (error)
        return { handled: true, status: 500, body: { error: error.message } }
      return { handled: true, body: ok(count ?? 0) }
    }
  }

  if (method === 'GET' && table === 'technologies') {
    if (segments[1] === 'get-site-technologies' && segments.length === 3) {
      const site = segments[2]
      const { data, error } = await supabase
        .from('technologies')
        .select('*')
        .eq('category', site)
        .order('id', { ascending: true })
      if (error)
        return { handled: true, status: 500, body: { error: error.message } }
      return { handled: true, body: ok(data || []) }
    }
    if (segments[1] === 'get-by-category' && segments.length === 3) {
      const category = segments[2]
      const { data, error } = await supabase
        .from('technologies')
        .select('*')
        .eq('category', category)
        .order('id', { ascending: true })
      if (error)
        return { handled: true, status: 500, body: { error: error.message } }
      return { handled: true, body: ok(data || []) }
    }
    if (segments[1] === 'count-by-created-last-week' && segments.length === 2) {
      const { count, error } = await supabase
        .from('technologies')
        .select('*', { count: 'exact', head: true })
        .gte('created_at', oneWeekAgoIso())
      if (error)
        return { handled: true, status: 500, body: { error: error.message } }
      return { handled: true, body: ok(count ?? 0) }
    }
  }

  if (method === 'GET' && segments.length === 1) {
    const { data, error } = await supabase.from(table).select('*')
    if (error)
      return { handled: true, status: 500, body: { error: error.message } }
    const rows = data || []
    return { handled: true, body: ok(formatRowsResponseTimestamps(rows)) }
  }
  if (method === 'POST' && segments.length === 1)
    return {
      handled: true,
      status: 501,
      body: { error: 'Use module write flow.' },
    }
  return { handled: true, status: 405, body: { error: 'Method not allowed' } }
}

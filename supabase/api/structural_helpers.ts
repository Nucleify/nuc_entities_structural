import type { EqGetRoute } from 'nuc_api'

export const questionEqRoutes: EqGetRoute[] = [
  {
    match: (s) => s[1] === 'get-site-questions' && s.length === 3,
    table: 'questions',
    eq: (s) => ({ category: s[2]! }),
    order: { column: 'index', ascending: true },
  },
  {
    match: (s) => s[1] === 'get-site-questions' && s.length === 4,
    table: 'questions',
    eq: (s) => ({ category: s[2]!, lang: s[3]! }),
    order: { column: 'index', ascending: true },
  },
  {
    match: (s) => s[1] === 'get-by-category' && s.length === 3,
    table: 'questions',
    eq: (s) => ({ category: s[2]! }),
    order: { column: 'index', ascending: true },
  },
]

export const technologyEqRoutes: EqGetRoute[] = [
  {
    match: (s) => s[1] === 'get-site-technologies' && s.length === 3,
    table: 'technologies',
    eq: (s) => ({ category: s[2]! }),
    order: { column: 'id', ascending: true },
  },
  {
    match: (s) => s[1] === 'get-by-category' && s.length === 3,
    table: 'technologies',
    eq: (s) => ({ category: s[2]! }),
    order: { column: 'id', ascending: true },
  },
]

export const STRUCTURAL_TABLES = new Set(['questions', 'technologies'])

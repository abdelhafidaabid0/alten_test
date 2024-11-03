// env.d.ts
/// <reference types="vite/client" />

import { DefineComponent } from 'vue';

interface ImportMeta {
    readonly env: ImportMetaEnv;
    glob: (path: string) => Record<string, () => Promise<DefineComponent>>;
}

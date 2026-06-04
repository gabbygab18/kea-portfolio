@extends('layouts.admin')
@section('page-title', 'Add Skill')
@section('topbar-actions')
    <a href="{{ route('admin.skills.index') }}" class="btn-admin btn-admin-secondary">← Back</a>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    <style>
        .icon-picker-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 0.4rem;
            max-height: 220px;
            overflow-y: auto;
            padding: 0.5rem;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            border: 1px solid #333;
            margin-top: 0.5rem;
        }

        .icon-picker-grid button {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.25rem;
            padding: 0.5rem 0.25rem;
            border-radius: 8px;
            border: 1px solid transparent;
            background: transparent;
            cursor: pointer;
            transition: all 0.2s;
            color: var(--a-text, #fff);
        }

        .icon-picker-grid button:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: #555;
        }

        .icon-picker-grid button.selected {
            background: rgba(255, 255, 255, 0.1);
            border-color: #fff;
        }

        .icon-picker-grid button i {
            font-size: 1.5rem;
        }

        .icon-picker-grid button img {
            width: 1.5rem;
            height: 1.5rem;
            object-fit: contain;
            filter: brightness(0) invert(1);
            opacity: .85;
        }

        .icon-picker-grid button span {
            font-size: 0.55rem;
            color: #888;
            text-align: center;
            line-height: 1.2;
            word-break: break-all;
        }

        .icon-preview-box {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            border: 1px solid #333;
            margin-top: 0.5rem;
        }

        .icon-preview-box i {
            font-size: 1.8rem;
        }

        .icon-preview-box img {
            width: 1.8rem;
            height: 1.8rem;
            object-fit: contain;
            filter: brightness(0) invert(1);
            opacity: .85;
        }

        .icon-preview-box span {
            font-size: 0.8rem;
            color: #888;
            font-family: monospace;
        }

        .icon-search {
            width: 100%;
            padding: 0.5rem 0.75rem;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid #333;
            border-radius: 8px;
            color: inherit;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .icon-search:focus {
            outline: none;
            border-color: #fff;
        }

        .icon-tabs {
            display: flex;
            gap: 0.4rem;
            margin-top: 0.5rem;
            flex-wrap: wrap;
        }

        .icon-tab {
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
            border: 1px solid #444;
            background: transparent;
            color: #aaa;
            font-size: 0.72rem;
            cursor: pointer;
            transition: all 0.15s;
        }

        .icon-tab:hover {
            border-color: #666;
            color: #fff;
        }

        .icon-tab.active {
            background: rgba(255, 255, 255, 0.1);
            border-color: #fff;
            color: #fff;
        }
    </style>
@endpush

@section('content')
    <div class="admin-card">
        <form method="POST" action="{{ route('admin.skills.store') }}" class="admin-form">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required />
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="category" value="{{ old('category') }}" />
                </div>
            </div>
            <div class="form-group">
                <label>Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" />
            </div>
            <div class="form-group">
                <label>Icon</label>
                <input type="hidden" name="icon" id="addSkillIcon" />
                <div class="icon-preview-box" id="addPreviewBox">
                    <span id="addIconPlaceholder" style="font-size:1.8rem;opacity:0.3">?</span>
                    <span id="addIconPreviewLabel">No icon selected</span>
                </div>
                <div class="icon-tabs" id="addIconTabs"></div>
                <input type="text" class="icon-search" id="addIconSearch"
                    placeholder="Search icons… (e.g. figma, react, php)" />
                <div class="icon-picker-grid" id="addIconGrid"></div>
            </div>
            <button type="submit" class="btn-admin btn-admin-primary">Save Skill</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        const ICONS = [
            { label: 'Canva', type: 'si', slug: 'canva', cat: 'Design' },
            { label: 'CapCut', type: 'si', slug: 'capcut', cat: 'Design' },
            { label: 'Adobe', type: 'si', slug: 'adobe', cat: 'Design' },
            { label: 'Notion', type: 'si', slug: 'notion', cat: 'Design' },
            { label: 'Miro', type: 'si', slug: 'miro', cat: 'Design' },
            { label: 'Framer', type: 'si', slug: 'framer', cat: 'Design' },
            { label: 'Webflow', type: 'si', slug: 'webflow', cat: 'Design' },
            { label: 'Lottiefiles', type: 'si', slug: 'lottiefiles', cat: 'Design' },
            { label: 'Figma', type: 'devicon', cls: 'devicon-figma-plain', cat: 'Design' },
            { label: 'Photoshop', type: 'devicon', cls: 'devicon-photoshop-plain', cat: 'Design' },
            { label: 'Illustrator', type: 'devicon', cls: 'devicon-illustrator-plain', cat: 'Design' },
            { label: 'After Effects', type: 'devicon', cls: 'devicon-aftereffects-plain', cat: 'Design' },
            { label: 'Premiere Pro', type: 'devicon', cls: 'devicon-premierepro-plain', cat: 'Design' },
            { label: 'InDesign', type: 'devicon', cls: 'devicon-indesign-plain', cat: 'Design' },
            { label: 'Lightroom', type: 'devicon', cls: 'devicon-lightroom-plain', cat: 'Design' },
            { label: 'XD', type: 'devicon', cls: 'devicon-xd-plain', cat: 'Design' },
            { label: 'Sketch', type: 'devicon', cls: 'devicon-sketch-line', cat: 'Design' },
            { label: 'Blender', type: 'devicon', cls: 'devicon-blender-original', cat: 'Design' },
            { label: 'HTML5', type: 'devicon', cls: 'devicon-html5-plain', cat: 'Frontend' },
            { label: 'CSS3', type: 'devicon', cls: 'devicon-css3-plain', cat: 'Frontend' },
            { label: 'Sass', type: 'devicon', cls: 'devicon-sass-original', cat: 'Frontend' },
            { label: 'JavaScript', type: 'devicon', cls: 'devicon-javascript-plain', cat: 'Frontend' },
            { label: 'TypeScript', type: 'devicon', cls: 'devicon-typescript-plain', cat: 'Frontend' },
            { label: 'React', type: 'devicon', cls: 'devicon-react-original', cat: 'Frontend' },
            { label: 'Vue', type: 'devicon', cls: 'devicon-vuejs-plain', cat: 'Frontend' },
            { label: 'Angular', type: 'devicon', cls: 'devicon-angularjs-plain', cat: 'Frontend' },
            { label: 'Tailwind', type: 'devicon', cls: 'devicon-tailwindcss-plain', cat: 'Frontend' },
            { label: 'Bootstrap', type: 'devicon', cls: 'devicon-bootstrap-plain', cat: 'Frontend' },
            { label: 'Next.js', type: 'devicon', cls: 'devicon-nextjs-plain', cat: 'Frontend' },
            { label: 'Nuxt', type: 'devicon', cls: 'devicon-nuxtjs-plain', cat: 'Frontend' },
            { label: 'Vite', type: 'devicon', cls: 'devicon-vitejs-plain', cat: 'Frontend' },
            { label: 'PHP', type: 'devicon', cls: 'devicon-php-plain', cat: 'Backend' },
            { label: 'Laravel', type: 'devicon', cls: 'devicon-laravel-plain', cat: 'Backend' },
            { label: 'Node.js', type: 'devicon', cls: 'devicon-nodejs-plain', cat: 'Backend' },
            { label: 'Python', type: 'devicon', cls: 'devicon-python-plain', cat: 'Languages' },
            { label: 'Java', type: 'devicon', cls: 'devicon-java-plain', cat: 'Languages' },
            { label: 'C#', type: 'devicon', cls: 'devicon-csharp-plain', cat: 'Languages' },
            { label: 'MySQL', type: 'devicon', cls: 'devicon-mysql-plain', cat: 'Database' },
            { label: 'PostgreSQL', type: 'devicon', cls: 'devicon-postgresql-plain', cat: 'Database' },
            { label: 'MongoDB', type: 'devicon', cls: 'devicon-mongodb-plain', cat: 'Database' },
            { label: 'Firebase', type: 'devicon', cls: 'devicon-firebase-plain', cat: 'Database' },
            { label: 'Git', type: 'devicon', cls: 'devicon-git-plain', cat: 'DevOps' },
            { label: 'GitHub', type: 'devicon', cls: 'devicon-github-original', cat: 'DevOps' },
            { label: 'Docker', type: 'devicon', cls: 'devicon-docker-plain', cat: 'DevOps' },
            { label: 'VS Code', type: 'devicon', cls: 'devicon-vscode-plain', cat: 'Tools' },
            { label: 'Jira', type: 'devicon', cls: 'devicon-jira-plain', cat: 'Tools' },
            { label: 'WordPress', type: 'devicon', cls: 'devicon-wordpress-plain', cat: 'Tools' },
            { label: 'YouTube', type: 'si', slug: 'youtube', cat: 'Platforms' },
            { label: 'Instagram', type: 'si', slug: 'instagram', cat: 'Platforms' },
            { label: 'LinkedIn', type: 'si', slug: 'linkedin', cat: 'Platforms' },
            { label: 'Shopify', type: 'si', slug: 'shopify', cat: 'Platforms' },
        ];

        const SI_CDN = slug => `https://cdn.simpleicons.org/${slug}`;

        function iconValue(icon) {
            return icon.type === 'si' ? `si:${icon.slug}` : icon.cls;
        }

        function renderIconEl(containerId, value, size = '1.8rem') {
            const container = document.getElementById(containerId);
            if (!container) return;
            container.querySelectorAll('img, i').forEach(el => el.remove());
            const placeholder = container.querySelector('[id$="IconPlaceholder"]');
            if (placeholder) placeholder.style.display = 'none';
            if (!value) return;
            if (value.startsWith('si:')) {
                const img = document.createElement('img');
                img.src = SI_CDN(value.slice(3));
                img.style.cssText = `width:${size};height:${size};object-fit:contain;filter:brightness(0) invert(1);opacity:.85`;
                container.prepend(img);
            } else {
                const i = document.createElement('i');
                i.className = value + ' colored';
                i.style.fontSize = size;
                container.prepend(i);
            }
        }

        function buildGrid(gridId, inputId, previewBoxId, previewLabelId, filter = '', selectedValue = '', activeCat = 'All') {
            const gridEl = document.getElementById(gridId);
            const inputEl = document.getElementById(inputId);
            if (!gridEl || !inputEl) return;

            const tabsId = gridId.replace('Grid', 'Tabs');
            const tabsEl = document.getElementById(tabsId);
            const cats = ['All', ...new Set(ICONS.map(i => i.cat))];

            if (tabsEl) {
                tabsEl.innerHTML = cats.map(c => `
                <button type="button" class="icon-tab ${c === activeCat ? 'active' : ''}"
                    onclick="switchTab('${c}','${gridId}','${inputId}','${previewBoxId}','${previewLabelId}','${tabsId}',this)">
                    ${c}
                </button>`).join('');
            }

            const filtered = ICONS.filter(icon => {
                const matchCat = activeCat === 'All' || icon.cat === activeCat;
                const matchQ = !filter
                    || icon.label.toLowerCase().includes(filter.toLowerCase())
                    || (icon.slug || '').toLowerCase().includes(filter.toLowerCase())
                    || (icon.cls || '').toLowerCase().includes(filter.toLowerCase());
                return matchCat && matchQ;
            });

            gridEl.innerHTML = filtered.map(icon => {
                const val = iconValue(icon);
                const isActive = val === selectedValue;
                const imgOrI = icon.type === 'si'
                    ? `<img src="${SI_CDN(icon.slug)}" style="width:1.5rem;height:1.5rem;object-fit:contain;filter:brightness(0) invert(1);opacity:.85"/>`
                    : `<i class="${icon.cls} colored"></i>`;
                return `<button type="button" class="${isActive ? 'selected' : ''}" title="${icon.label}"
                onclick="selectIcon('${val}','${gridId}','${inputId}','${previewBoxId}','${previewLabelId}',event)">
                ${imgOrI}<span>${icon.label}</span></button>`;
            }).join('');
        }

        function switchTab(cat, gridId, inputId, previewBoxId, previewLabelId, tabsId, btn) {
            document.querySelectorAll(`#${tabsId} .icon-tab`).forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const searchId = gridId.replace('Grid', 'Search');
            const q = document.getElementById(searchId)?.value || '';
            buildGrid(gridId, inputId, previewBoxId, previewLabelId, q, document.getElementById(inputId).value, cat);
        }

        function selectIcon(val, gridId, inputId, previewBoxId, previewLabelId, e) {
            document.getElementById(inputId).value = val;
            renderIconEl(previewBoxId, val, '1.8rem');
            const labelEl = document.getElementById(previewLabelId);
            if (labelEl) labelEl.textContent = val;
            document.querySelectorAll(`#${gridId} button`).forEach(b => b.classList.remove('selected'));
            e.currentTarget.classList.add('selected');
        }

        document.addEventListener('DOMContentLoaded', () => {
            buildGrid('addIconGrid', 'addSkillIcon', 'addPreviewBox', 'addIconPreviewLabel', '', '', 'All');

            document.getElementById('addIconSearch').addEventListener('input', function () {
                const activeCat = document.querySelector('#addIconTabs .icon-tab.active')?.textContent.trim() || 'All';
                buildGrid('addIconGrid', 'addSkillIcon', 'addPreviewBox', 'addIconPreviewLabel',
                    this.value, document.getElementById('addSkillIcon').value, activeCat);
            });
        });
    </script>
@endpush

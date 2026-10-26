{{-- Auto-growing textareas with a tiny formatting toolbar for any textarea.doc-text (works on dynamically added rows). --}}
<style>
.dt-toolbar { display: flex; gap: 4px; margin-bottom: 4px; }
.dt-toolbar button { border: 1px solid rgba(11,31,51,.15); background: #fff; color: #0B1F33; border-radius: 6px; font-size: .75rem; line-height: 1; padding: 4px 8px; }
.dt-toolbar button:hover { background: #E8F3FA; border-color: #0773B9; color: #0773B9; }
textarea.doc-text { min-height: 64px; resize: vertical; overflow: hidden; }
.dt-hint { font-size: .72rem; color: #546270; margin-top: 3px; }
</style>
<script>
(function () {
    function grow(ta) { ta.style.height = 'auto'; ta.style.height = (ta.scrollHeight + 2) + 'px'; }

    function wrap(ta, before, after) {
        var s = ta.selectionStart, e = ta.selectionEnd, v = ta.value;
        ta.value = v.slice(0, s) + before + v.slice(s, e) + after + v.slice(e);
        ta.selectionStart = s + before.length;
        ta.selectionEnd = e + before.length;
    }

    function prefixLines(ta, prefix) {
        var v = ta.value, s = ta.selectionStart, e = ta.selectionEnd;
        var start = v.lastIndexOf('\n', s - 1) + 1;
        var block = v.slice(start, e).split('\n').map(function (l) {
            return l.indexOf(prefix) === 0 ? l.slice(prefix.length) : prefix + l;
        }).join('\n');
        ta.value = v.slice(0, start) + block + v.slice(e);
        ta.selectionStart = start;
        ta.selectionEnd = start + block.length;
    }

    function addToolbar(ta) {
        if (ta.dataset.dtReady || ta.readOnly) return;
        ta.dataset.dtReady = '1';
        var bar = document.createElement('div');
        bar.className = 'dt-toolbar';
        [['B', 'Bold', function () { wrap(ta, '**', '**'); }],
         ['• List', 'Bullet list', function () { prefixLines(ta, '- '); }],
         ['H', 'Sub-heading', function () { prefixLines(ta, '# '); }]
        ].forEach(function (b) {
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.textContent = b[0];
            btn.title = b[1];
            btn.addEventListener('mousedown', function (ev) { ev.preventDefault(); });
            btn.addEventListener('click', function () { b[2](); ta.focus(); grow(ta); });
            bar.appendChild(btn);
        });
        ta.parentNode.insertBefore(bar, ta);
        var hint = document.createElement('div');
        hint.className = 'dt-hint';
        hint.textContent = 'Start lines with "- " for bullets. Blank line = new paragraph. **bold**, "# " heading.';
        ta.parentNode.insertBefore(hint, ta.nextSibling);
        grow(ta);
    }

    document.addEventListener('focusin', function (e) {
        if (e.target.matches && e.target.matches('textarea.doc-text')) addToolbar(e.target);
    });
    document.addEventListener('input', function (e) {
        if (e.target.matches && e.target.matches('textarea.doc-text')) grow(e.target);
    });
    // Enter on a bullet line continues the list; Enter on an empty bullet ends it.
    document.addEventListener('keydown', function (e) {
        var ta = e.target;
        if (e.key !== 'Enter' || e.shiftKey || !ta.matches || !ta.matches('textarea.doc-text')) return;
        var v = ta.value, pos = ta.selectionStart;
        var ls = v.lastIndexOf('\n', pos - 1) + 1;
        var m = v.slice(ls, pos).match(/^(\s*[-•*]\s+)(.*)$/);
        if (!m) return;
        e.preventDefault();
        if (m[2] === '') {
            ta.value = v.slice(0, ls) + v.slice(pos);
            ta.selectionStart = ta.selectionEnd = ls;
        } else {
            ta.value = v.slice(0, pos) + '\n' + m[1] + v.slice(ta.selectionEnd);
            ta.selectionStart = ta.selectionEnd = pos + 1 + m[1].length;
        }
        grow(ta);
    });
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('textarea.doc-text').forEach(function (ta) { if (ta.value) grow(ta); });
    });

    // Programmatic fill helper: sets the value and resizes.
    window.bwSetDocText = function (ta, value) { ta.value = value; grow(ta); };
})();
</script>

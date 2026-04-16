function selectAllSetup(selectAllBtn, inputs) {
    const selectAll = document.querySelector(`.permissions-pg #${selectAllBtn}`);
    const childrenInputs = document.querySelectorAll(`.permissions-pg .${inputs} .child`);

    if (!selectAll) return;

    selectAll.addEventListener("change", () => {
        childrenInputs.forEach((btn) => {
            btn.checked = selectAll.checked;
        });
    });
}

selectAllSetup("members", "members-inputs");
selectAllSetup("photography-requests", "photo-req-inputs");
selectAllSetup("events-requests", "events-req-inputs");
selectAllSetup("facility-requests", "facility-req-inputs");
selectAllSetup("adv-requests", "adv-req-inputs");
selectAllSetup("reports", "rpt-inputs");
selectAllSetup("settings", "settings-inputs");
selectAllSetup("logs", "logs-inputs");
selectAllSetup("users", "users-inputs");
